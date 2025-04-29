<?php

/**
 * CoreXPHP QueryBuilder Class
 * 
 * This class helps build and execute SQL queries in an expressive, chainable style.
 */
class QueryBuilder
{
    protected $db;             // PDO database connection
    protected $query;          // Raw SQL query being built
    protected $bindings = [];  // Bound parameters
    protected $table;          // Current table
    protected $whereAdded = false; // Flag to track WHERE clause

    public function __construct($db = null, $table = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
        if ($table) {
            $this->setTable($table);
        }
    }

    /** Create a new QueryBuilder for a specific table */
    public static function table($table)
    {
        return (new self())->setTable($table);
    }

    /** Set the table and default SELECT query */
    public function setTable($table)
    {
        $this->table = $table;
        $this->query = "SELECT * FROM " . $this->quoteIdentifier($table);
        return $this;
    }

    /*================== CRUD ==================*/

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
        if (!$this->whereAdded) {
            throw new Exception("Update operation requires a WHERE clause.");
        }

        $set = [];
        foreach ($data as $col => $val) {
            $set[] = $this->quoteIdentifier($col) . " = :$col";
            $this->bindings[$col] = $val;
        }

        $this->query = "UPDATE " . $this->quoteIdentifier($this->table)
                     . " SET " . implode(", ", $set)
                     . " " . $this->getWhereClause();

        return $this->execute();
    }

    public function delete()
    {
        if (!$this->whereAdded) {
            throw new Exception("Delete operation requires a WHERE clause.");
        }

        $this->query = "DELETE FROM " . $this->quoteIdentifier($this->table) . " " . $this->getWhereClause();
        return $this->execute();
    }

    public function truncate()
    {
        $this->query = "TRUNCATE TABLE " . $this->quoteIdentifier($this->table);
        return $this->execute();
    }

    /*================== WHERE ==================*/

    public function where($column, $operator, $value)
    {
        $this->addWhereClause();
        $placeholder = $this->createBindingKey($column);
        $this->query .= " " . $this->quoteIdentifier($column) . " $operator :$placeholder";
        $this->bindings[$placeholder] = $value;
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $placeholder = "or_" . $this->createBindingKey($column);
        $this->query .= $this->whereAdded ? " OR" : " WHERE";
        $this->query .= " " . $this->quoteIdentifier($column) . " $operator :$placeholder";
        $this->bindings[$placeholder] = $value;
        $this->whereAdded = true;
        return $this;
    }

    public function whereIn($column, array $values)
    {
        $this->addWhereClause();
        $placeholders = [];

        foreach ($values as $i => $value) {
            $key = $this->createBindingKey("{$column}_in_$i");
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }

        $this->query .= " " . $this->quoteIdentifier($column) . " IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }

    public function whereNotIn($column, array $values)
    {
        $this->addWhereClause();
        $placeholders = [];

        foreach ($values as $i => $value) {
            $key = $this->createBindingKey("{$column}_notin_$i");
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }

        $this->query .= " " . $this->quoteIdentifier($column) . " NOT IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }

    public function whereNull($column)
    {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " IS NULL";
        return $this;
    }

    public function whereNotNull($column)
    {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " IS NOT NULL";
        return $this;
    }

    public function whereBetween($column, $range)
    {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereNotBetween($column, $range)
    {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " NOT BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function filter(array $conditions)
    {
        foreach ($conditions as $column => $value) {
            if (is_array($value)) {
                $this->whereIn($column, $value);
            } elseif ($value === 'NULL') {
                $this->whereNull($column);
            } elseif ($value === 'NOT NULL') {
                $this->whereNotNull($column);
            } else {
                $this->where($column, '=', $value);
            }
        }
        return $this;
    }

    /*================== FETCH ==================*/

    public function select($columns = ['*'])
    {
        $quoted = array_map([$this, 'quoteIdentifier'], $columns);
        $this->query = "SELECT " . implode(', ', $quoted) . " FROM " . $this->quoteIdentifier($this->table);
        return $this;
    }

    public function get()
    {
        $stmt = $this->db->prepare($this->query);
        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":$key", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function count($column = '*')
    {
        // Save WHERE part only (before ORDER BY / LIMIT)
        $whereClause = $this->getWhereClause();
    
        // Only keep WHERE bindings
        $whereBindings = [];
        foreach ($this->bindings as $key => $value) {
            if (!in_array($key, ['limit', 'offset'])) {
                $whereBindings[$key] = $value;
            }
        }
    
        $sql = "SELECT COUNT(*) AS count FROM " . $this->quoteIdentifier($this->table) . " " . $whereClause;
    
        $stmt = $this->db->prepare($sql);
        foreach ($whereBindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->count ?? 0;
    }
    
    /*================== Aggregates ==================*/

    public function sum($column) { return $this->aggregate("SUM", $column); }
    public function avg($column) { return $this->aggregate("AVG", $column); }
    public function min($column) { return $this->aggregate("MIN", $column); }
    public function max($column) { return $this->aggregate("MAX", $column); }

    protected function aggregate($function, $column)
    {
        $this->query = "SELECT $function(" . $this->quoteIdentifier($column) . ") AS value FROM " . $this->quoteIdentifier($this->table);
        $result = $this->get();
        return $result[0]->value ?? 0;
    }

    /*================== Utilities ==================*/

    public function orderBy($column, $direction = 'ASC')
    {
        $this->query .= " ORDER BY " . $this->quoteIdentifier($column) . " " . strtoupper($direction);
        return $this;
    }

    public function limit($limit)
    {
        $this->query .= " LIMIT :limit";
        $this->bindings['limit'] = (int)$limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->query .= " OFFSET :offset";
        $this->bindings['offset'] = (int)$offset;
        return $this;
    }

    public function paginate($page = 1, $perPage = 15)
    {
        $offset = ($page - 1) * $perPage;
        return $this->limit($perPage)->offset($offset);
    }

    public function toSql()
    {
        $sql = $this->query;
        foreach ($this->bindings as $key => $val) {
            $sql = str_replace(":$key", is_numeric($val) ? $val : "'$val'", $sql);
        }
        return $sql;
    }

    public function logQuery($file = '../app/logs/query.log')
    {
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        file_put_contents($file, "[" . date('Y-m-d H:i:s') . "] " . $this->toSql() . PHP_EOL, FILE_APPEND);
        return $this;
    }

    /*================== Internals ==================*/

    protected function addWhereClause()
    {
        if (!$this->whereAdded) {
            $this->query .= " WHERE";
            $this->whereAdded = true;
        } else {
            $this->query .= " AND";
        }
    }

    protected function getWhereClause()
    {
        $pos = strpos($this->query, 'WHERE');
        return $pos !== false ? substr($this->query, $pos) : '';
    }

    protected function quoteIdentifier($identifier)
    {
        $parts = explode('.', $identifier);
        foreach ($parts as &$part) {
            $part = "`" . str_replace("`", "``", $part) . "`";
        }
        return implode('.', $parts);
    }

    protected function createBindingKey($column)
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '_', $column) . '_' . count($this->bindings);
    }

    public function execute()
    {
        $stmt = $this->db->prepare($this->query);
        foreach ($this->bindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        return $stmt->execute();
    }
}
