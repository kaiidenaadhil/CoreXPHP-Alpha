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

    // === Constructor ===
    public function __construct($db = null, $table = null)
    {
        $this->db = $db ?? Database::getInstance()->getConnection();
        if ($table) {
            $this->setTable($table);
        }
    }

    // === Table Setup ===
    public static function table($table)
    {
        return (new self())->setTable($table);
    }
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    // === Internal: Ensures proper WHERE handling in legacy raw SQL mode ===
    protected function addWhereClause()
    {
        if (!$this->query) return;
        if (stripos($this->query, 'WHERE') === false) {
            $this->query .= ' WHERE';
        } else {
            $this->query .= ' AND';
        }
    }

    protected function getWhereClause()
    {
        if (!empty($this->wheres)) {
            $this->whereAdded = true;
            return " WHERE " . implode(' AND ', $this->wheres);
        }
        return "";
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

          if (empty($this->wheres)) {
            throw new Exception("Update/Delete operation requires a WHERE clause.");
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
        if (empty($this->wheres)) {
            throw new Exception("Update/Delete operation requires a WHERE clause.");
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

    // === Join Clauses ===
    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $this->joins[] = strtoupper($type) . " JOIN `$table` ON `$first` $operator `$second`";
        return $this;
    }

    // === Grouping and Having ===
    public function groupBy($columns)
    {
        $columns = is_array($columns) ? $columns : [$columns];
        $this->groups = array_map([$this, 'quoteIdentifier'], $columns);
        return $this;
    }

    public function having($column, $operator, $value)
    {
        $key = $this->createBindingKey("having_$column");
        $this->havings[] = "$column $operator :$key";
        $this->bindings[$key] = $value;
        return $this;
    }

    // === Where Clauses ===
    public function where($column, $operator = null, $value = null)
    {
        if (is_callable($column)) {
            $nested = new self($this->db, $this->table);
            $column($nested);
            if (!empty($nested->wheres)) {
                $joined = implode(' ', $nested->wheres);
                $joined = preg_replace('/^OR /', '', $joined); // Remove leading OR
                $this->wheres[] = "($joined)";
                $this->bindings = array_merge($this->bindings, $nested->bindings);
            }
            return $this;
        }

        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $key = $this->createBindingKey($column);
        $this->wheres[] = "`$column` $operator :$key";
        $this->bindings[$key] = $value;
        return $this;
    }

    

    public function orWhere($column, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $key = $this->createBindingKey("or_$column");
        $this->wheres[] = "OR `$column` $operator :$key";
        $this->bindings[$key] = $value;
        return $this;
    }

    public function whereBetween($column, $range)
    {
        $this->wheres[] = "`$column` BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereNotBetween($column, $range)
    {
        $this->wheres[] = "`$column` NOT BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereIn($column, array $values)
    {
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
        $placeholders = [];
        foreach ($values as $i => $value) {
            $key = $this->createBindingKey("{$column}_notin_$i");
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }
        $this->wheres[] = "`$column` NOT IN (" . implode(", ", $placeholders) . ")";
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
        $this->addWhereClause();
        $this->wheres[] = $sql;
        return $this;
    }

    // === Select and Query ===
    public function select($columns = ['*'])
    {
        $quoted = array_map([$this, 'quoteIdentifier'], $columns);
        $this->query = "SELECT " . implode(', ', $quoted) . " FROM " . $this->quoteIdentifier($this->table);
        return $this;
    }


    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
    


    public function selectRaw($rawSql)
{
    $this->query = "SELECT $rawSql FROM " . $this->quoteIdentifier($this->table);
    return $this;
}



    // === Ordering, Limit, Offset ===
    public function orderBy($column, $direction = 'ASC')
    {
        $this->order = "ORDER BY `" . $column . "` " . strtoupper($direction);
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

    // === Execution ===
    public function get()
    {
        $sql = $this->query ?: "SELECT * FROM " . $this->quoteIdentifier($this->table);

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

    public function count($column = '*')
    {
        $sql = "SELECT COUNT($column) AS aggregate FROM " . $this->quoteIdentifier($this->table);

        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }

        $stmt = $this->db->prepare($sql);
        foreach ($this->bindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return (int)($result->aggregate ?? 0);
    }


    public function sum($column)
{
    return $this->aggregate("SUM", $column);
}

public function avg($column)
{
    return $this->aggregate("AVG", $column);
}

public function min($column)
{
    return $this->aggregate("MIN", $column);
}

public function max($column)
{
    return $this->aggregate("MAX", $column);
}

protected function aggregate($function, $column)
{
    $sql = "SELECT $function(" . $this->quoteIdentifier($column) . ") AS value FROM " . $this->quoteIdentifier($this->table);

    if (!empty($this->wheres)) {
        $sql .= " WHERE " . implode(' AND ', $this->wheres);
    }

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

        $total = $this->count();
        $this->limit($perPage)->offset(($page - 1) * $perPage);

        $this->paginationMeta = [
            'total'       => $total,
            'totalPages'  => ceil($total / $perPage),
            'currentPage' => $page,
            'perPage'     => $perPage,
        ];

        return $this;
    }


    // === Helper Methods ===

// === Debugging Helpers ===
public function toSql()
{
    $sql = $this->query ?: "SELECT * FROM " . $this->quoteIdentifier($this->table);

    if (!empty($this->joins)) $sql .= ' ' . implode(' ', $this->joins);
    if (!empty($this->wheres)) $sql .= " WHERE " . implode(' AND ', $this->wheres);
    if (!empty($this->groups)) $sql .= " GROUP BY " . implode(', ', $this->groups);
    if (!empty($this->havings)) $sql .= " HAVING " . implode(' AND ', $this->havings);
    if (!empty($this->order)) $sql .= " " . $this->order;
    if (isset($this->limit)) $sql .= " LIMIT " . $this->limit;
    if (isset($this->offset)) $sql .= " OFFSET " . $this->offset;

    foreach ($this->bindings as $key => $val) {
        $val = is_numeric($val) ? $val : "'$val'";
        $sql = str_replace(":$key", $val, $sql);
    }

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
        $stmt = $this->db->prepare($this->query);
        foreach ($this->bindings as $key => $val) {
            $stmt->bindValue(":$key", $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        return $stmt->execute();
    }
}