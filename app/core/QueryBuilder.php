<?php

class QueryBuilder
{
    // === Core Properties ===
    protected $db;
    protected $table;
    protected $query;
    protected $bindings = [];
    protected $wheres = [];
    protected $order;
    protected $limit;
    protected $offset;
    protected $joins = [];
    protected $groups = [];
    protected $havings = [];
    protected $whereAdded = false;
    protected $isPaginated = false;
    protected $paginationMeta = null;

    // NEW: Select handling
    protected $selects = ['*'];
    protected $rawSelect = null;

    // NEW: Aggregation support
    protected $aggregateFunction = null;
    protected $aggregateColumn = '*';

    public function __construct($db = null, $table = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
        if ($table) {
            $this->setTable($table);
        }
    }

    public static function table($table)
    {
        return (new self())->setTable($table);
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    // === CRUD Methods ===

    public function insert($data)
    {
        $columns = implode(", ", array_map([$this, 'quoteIdentifier'], array_keys($data)));
        $placeholders = ":" . implode(", :", array_keys($data));
        $this->query = "INSERT INTO " . $this->quoteIdentifier($this->table) . " ($columns) VALUES ($placeholders)";
        $this->bindings = $data;
        return $this->execute();
    }

    public function update($data)
    {
        if (empty($this->wheres)) {
            throw new Exception("Update/Delete operation requires a WHERE clause.");
        }
    
        // Prepare SET clause from the data
        $set = [];
        foreach ($data as $col => $val) {
            $set[] = $this->quoteIdentifier($col) . " = :$col";
            $this->bindings[$col] = $val; // Bind each value to the query
        }
    
        // Build the SQL query
        $this->query = "UPDATE " . $this->quoteIdentifier($this->table)
            . " SET " . implode(", ", $set)
            . " WHERE " . implode(' AND ', $this->wheres); // Use AND for all where conditions
    
        // Execute the query and return the result (true or false)
        return $this->execute(); // execute() returns a boolean
    }
    
    
    public function delete()
    {
        if (empty($this->wheres)) {
            throw new Exception("Update/Delete operation requires a WHERE clause.");
        }
    
        // Build the DELETE query
        $this->query = "DELETE FROM " . $this->quoteIdentifier($this->table) 
            . " WHERE " . implode(' AND ', $this->wheres); // Use AND for all where conditions
    
        return $this->execute(); // Execute the query
    }
    
    

    public function truncate()
    {
        $this->query = "TRUNCATE TABLE " . $this->quoteIdentifier($this->table);
        return $this->execute();
    }

    public function where($column, $operator = null, $value = null)
    {
        if (is_callable($column)) {
            $nested = new self($this->db, $this->table);
            $column($nested);
            if (!empty($nested->wheres)) {
                $joined = implode(' ', $nested->wheres);
                $this->wheres[] = "($joined)";
                $this->bindings = array_merge($this->bindings, $nested->bindings);
            }
            return $this;
        }
    
        // 🛠 FIXED: Detect shorthand form where('column', 'value') ➜ assume '='
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
    
        $key = $this->createBindingKey($column);
    
        // ✅ FIXED: Ensure correct SQL syntax with binding
        $this->wheres[] = $this->quoteIdentifier($column) . " $operator :$key";
        $this->bindings[$key] = $value;
    
        return $this;
    }
    
    

public function orWhere($column, $operator = null, $value = null)
{
    if (func_num_args() === 2) {
        // Default to equality if operator is not provided
        $value = $operator;
        $operator = '=';
    }

    // Create a unique key for binding
    $key = $this->createBindingKey("or_$column");
    $this->wheres[] = "OR " . $this->quoteIdentifier($column) . " $operator :$key";
    $this->bindings[$key] = $value;

    return $this; // Return instance for chaining
}


    public function whereIn($column, array $values)
    {
        if (empty($values)) {
            $this->wheres[] = "0=1";
            return $this;
        }
        $placeholders = [];
        foreach ($values as $i => $value) {
            $key = $this->createBindingKey("{$column}_in_$i");
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }
        $this->wheres[] = "`$column` IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }

    public function whereNotIn($column, array $values)
    {
        if (empty($values)) {
            return $this;
        }
        $placeholders = [];
        foreach ($values as $i => $value) {
            $key = $this->createBindingKey("{$column}_notin_$i");
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }
        $this->wheres[] = "`$column` NOT IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }

    public function whereBetween($column, array $range)
    {
        $this->wheres[] = "`$column` BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereNotBetween($column, array $range)
    {
        $this->wheres[] = "`$column` NOT BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereNull($column)
    {
        $this->wheres[] = "`$column` IS NULL";
        return $this;
    }

    public function whereNotNull($column)
    {
        $this->wheres[] = "`$column` IS NOT NULL";
        return $this;
    }

    public function whereRaw($sql)
    {
        $this->wheres[] = $sql;
        return $this;
    }

    public function hasWhere()
{
    return !empty($this->wheres);
}


    // === Other Selectors ===

    public function select($columns = ['*'])
    {
        $this->selects = $columns;
        return $this;
    }

    public function selectRaw($rawSql)
    {
        $this->rawSelect = $rawSql;
        return $this;
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }


    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $type = strtoupper($type);
        $join = sprintf(
            "%s JOIN %s ON %s %s %s",
            $type,
            $this->quoteIdentifier($table),
            $this->quoteIdentifier($first),
            $operator,
            $this->quoteIdentifier($second)
        );
    
        $this->joins[] = $join;
        return $this;
    }
    


    public function groupBy($columns)
    {
        $columns = is_array($columns) ? $columns : [$columns];
        $this->groups = array_map([$this, 'quoteIdentifier'], $columns);
        return $this;
    }

    public function having($column, $operator, $value)
    {
        $key = $this->createBindingKey("having_$column");
        $this->havings[] = $this->quoteIdentifier($column) . " $operator :$key";
        $this->bindings[$key] = $value;
        return $this;
    }




    // === Data Fetching and Aggregates ===

    public function get()
    {
        if ($this->aggregateFunction) {
            $column = $this->aggregateColumn === '*'
                ? '*'
                : $this->quoteIdentifier($this->aggregateColumn);
    
            $selectClause = "{$this->aggregateFunction}($column) AS value";
        } elseif ($this->rawSelect) {
            $selectClause = $this->rawSelect;
        } else {
            $selectClause = implode(', ', array_map(function ($col) {
                return $col === '*' ? '*' : $this->quoteIdentifier($col);
            }, $this->selects));
        }
    
        $sql = "SELECT $selectClause FROM " . $this->quoteIdentifier($this->table);
    
        if (!empty($this->joins)) $sql .= ' ' . implode(' ', $this->joins);
        if (!empty($this->wheres)) $sql .= " WHERE " . implode(' AND ', $this->wheres);
        if (!empty($this->groups)) $sql .= " GROUP BY " . implode(', ', $this->groups);
        if (!empty($this->havings)) $sql .= " HAVING " . implode(' AND ', $this->havings);
        if (!empty($this->order)) $sql .= " " . $this->order;
        if (isset($this->limit)) {
            $sql .= " LIMIT :limit";
            $this->bindings['limit'] = $this->limit;
        }
        if (isset($this->offset)) {
            $sql .= " OFFSET :offset";
            $this->bindings['offset'] = $this->offset;
        }
    
        $stmt = $this->db->prepare($sql);
    
        foreach ($this->bindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    
        if ($this->isPaginated) {
            return [
                'data' => $results,
                'meta' => $this->paginationMeta
            ];
        }
    
        return $results;
    }
    

    public function count($column = '*') { $this->aggregateFunction = 'COUNT'; $this->aggregateColumn = $column; return $this->getAggregateValue(); }
    public function sum($column)        { $this->aggregateFunction = 'SUM';   $this->aggregateColumn = $column; return $this->getAggregateValue(); }
    public function avg($column)        { $this->aggregateFunction = 'AVG';   $this->aggregateColumn = $column; return $this->getAggregateValue(); }
    public function min($column)        { $this->aggregateFunction = 'MIN';   $this->aggregateColumn = $column; return $this->getAggregateValue(); }
    public function max($column)        { $this->aggregateFunction = 'MAX';   $this->aggregateColumn = $column; return $this->getAggregateValue(); }

    protected function getAggregateValue()
    {
        // Fix: Avoid quoting '*' in COUNT(*) and other aggregates
        $column = $this->aggregateColumn === '*'
            ? '*'
            : $this->quoteIdentifier($this->aggregateColumn);
    
        $selectClause = "{$this->aggregateFunction}($column) AS value";
        $sql = "SELECT $selectClause FROM " . $this->quoteIdentifier($this->table);
    
        if (!empty($this->joins)) $sql .= ' ' . implode(' ', $this->joins);
        if (!empty($this->wheres)) $sql .= " WHERE " . implode(' AND ', $this->wheres);
        if (!empty($this->groups)) $sql .= " GROUP BY " . implode(', ', $this->groups);
        if (!empty($this->havings)) $sql .= " HAVING " . implode(' AND ', $this->havings);
    
        $stmt = $this->db->prepare($sql);
        foreach ($this->bindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->value ?? 0;
    }
    

    public function paginate($page = 1, $perPage = 15)
    {
        $this->isPaginated = true;
        $total = $this->count(); // uses COUNT() internally
    
        // Reset the aggregate mode before calling get() again
        $this->aggregateFunction = null;
        $this->aggregateColumn = '*';
    
        $this->limit($perPage)->offset(($page - 1) * $perPage);
    
        $this->paginationMeta = [
            'total'       => $total,
            'totalPages'  => ceil($total / $perPage),
            'currentPage' => $page,
            'perPage'     => $perPage,
        ];
        return $this;
    }
    

    public function orderBy($column, $direction = 'ASC')
    {
        $this->order = "ORDER BY " . $this->quoteIdentifier($column) . " " . strtoupper($direction);
        return $this;
    }
    
    public function limit($limit)
    {
        $this->limit = (int)$limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = (int)$offset;
        return $this;
    }

    public function toSql()
    {
        if ($this->aggregateFunction) {
            $selectClause = "{$this->aggregateFunction}({$this->quoteIdentifier($this->aggregateColumn)}) AS value";
        } elseif ($this->rawSelect) {
            $selectClause = $this->rawSelect;
        } else {
            $selectClause = implode(', ', array_map(function ($col) {
                return $col === '*' ? '*' : $this->quoteIdentifier($col);
            }, $this->selects));
            
        }

        $sql = "SELECT $selectClause FROM " . $this->quoteIdentifier($this->table);
        if (!empty($this->joins)) $sql .= ' ' . implode(' ', $this->joins);
        if (!empty($this->wheres)) $sql .= " WHERE " . implode(' AND ', $this->wheres);
        if (!empty($this->groups)) $sql .= " GROUP BY " . implode(', ', $this->groups);
        if (!empty($this->havings)) $sql .= " HAVING " . implode(' AND ', $this->havings);
        if (!empty($this->order)) $sql .= " " . $this->order;
        if (isset($this->limit)) $sql .= " LIMIT " . $this->limit;
        if (isset($this->offset)) $sql .= " OFFSET " . $this->offset;

        // foreach ($this->bindings as $key => $val) {

        //     $val = is_numeric($val) ? $val : "'$val'";
        //     $sql = str_replace(":$key", $val, $sql);
        // }

        return $sql;
    }

    public function logQuery($file = '../logs/query.log')
    {
        $sql = $this->toSql();
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        file_put_contents($file, "[" . date('Y-m-d H:i:s') . "] " . $sql . PHP_EOL, FILE_APPEND);
        return $this;
    }

    protected function quoteIdentifier($identifier)
    {
        $parts = explode('.', $identifier);
        return implode('.', array_map(fn($part) => "`$part`", $parts));
    }

    protected function createBindingKey($base)
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '_', $base) . '_' . count($this->bindings);
    }

public function execute()
{
    // Log the final SQL and bindings for debugging
    $log = "[" . date('Y-m-d H:i:s') . "]\n";
    $log .= "QUERY: " . $this->query . "\n";
    $log .= "BINDINGS: " . print_r($this->bindings, true) . "\n";

    $logFile = __DIR__ . '/../logs/query_debug.log';
    if (!is_dir(dirname($logFile))) {
        mkdir(dirname($logFile), 0777, true);
    }
    file_put_contents($logFile, $log . "\n", FILE_APPEND);

    // Prepare and bind the statement
    $stmt = $this->db->prepare($this->query);
    foreach ($this->bindings as $key => $val) {
        $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }

    return $stmt->execute();
}


// End of class
}
