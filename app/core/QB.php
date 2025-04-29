<?php

class QueryBuilder
{
    protected $db;
    protected $query;
    protected $bindings = [];
    protected $table;
    protected $whereAdded = false;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Static initializer
    public static function table($table) {
        $instance = new self();
        return $instance->setTable($table);
    }

    // Set the target table
    public function setTable($table) {
        $this->table = $table;
        $this->query = "SELECT * FROM " . $this->quoteIdentifier($table);
        return $this;
    }

    // CRUD Methods
    public function insert($data) {
        $columns = implode(", ", array_map([$this, 'quoteIdentifier'], array_keys($data)));
        $placeholders = ":" . implode(", :", array_keys($data));
        $this->query = "INSERT INTO " . $this->quoteIdentifier($this->table) . " ($columns) VALUES ($placeholders)";
        $this->bindings = $data;
        return $this->execute();
    }

    public function update($data) {
        if (!$this->table) {
            throw new Exception("Table not set for update operation.");
        }
    
        if (!$this->whereAdded) {
            throw new Exception("Update query requires a WHERE clause to prevent accidental updates.");
        }
    
        // Build the SET part of the query
        $setClauses = [];
        foreach ($data as $column => $value) {
            $setClauses[] = $this->quoteIdentifier($column) . " = :$column";
            $this->bindings[$column] = $value;
        }
    
        // Construct the final UPDATE query, appending the existing WHERE clause
        $this->query = "UPDATE " . $this->quoteIdentifier($this->table) .
                       " SET " . implode(", ", $setClauses) .
                       " " . $this->getWhereClause();
    
        return $this->execute();
    }
    
    private function getWhereClause() {
        // Returns the WHERE clause already added to the query
        $whereStartPos = strpos($this->query, " WHERE");
        if ($whereStartPos !== false) {
            return substr($this->query, $whereStartPos);
        }
        throw new Exception("WHERE clause not found in the query.");
    }
    

    public function delete() {
        if (!$this->whereAdded) {
            throw new Exception("Delete operation requires a WHERE clause to prevent accidental deletions.");
        }
    
        $this->query = "DELETE FROM " . $this->quoteIdentifier($this->table) . $this->getWhereClause();
        return $this->execute(); // Automatically execute the delete query.
    }
    

    public function truncate() {
        if (!$this->table) {
            throw new Exception("Table not set for truncate operation.");
        }
    
        // Disable foreign key checks temporarily
        $this->query = "SET FOREIGN_KEY_CHECKS = 0";
        $this->execute();
    
        // Perform the TRUNCATE operation
        $this->query = "TRUNCATE TABLE " . $this->quoteIdentifier($this->table);
        $this->execute();
    
        // Re-enable foreign key checks
        $this->query = "SET FOREIGN_KEY_CHECKS = 1";
        $this->execute();
    
        return $this;
    }
    
    

    // Filtering Methods
    public function where($column, $operator, $value) {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " $operator :$column";
        $this->bindings[$column] = $value;
        return $this;
    }

    public function whereBetween($column, $range) {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }

    public function whereNotBetween($column, $range) {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " NOT BETWEEN :start AND :end";
        $this->bindings['start'] = $range[0];
        $this->bindings['end'] = $range[1];
        return $this;
    }


    public function orWhere($column, $operator, $value) {
        $this->query .= $this->whereAdded ? " OR" : " WHERE";
        $this->query .= " " . $this->quoteIdentifier($column) . " $operator :or_$column";
        $this->bindings["or_$column"] = $value;
        $this->whereAdded = true;
        return $this;
    }
    
    public function whereIn($column, array $values) {
        $this->addWhereClause();
        $placeholders = [];
        foreach ($values as $i => $value) {
            $key = "{$column}_in_$i";
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }
        $this->query .= " " . $this->quoteIdentifier($column) . " IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }
    
    public function whereNotIn($column, array $values) {
        $this->addWhereClause();
        $placeholders = [];
        foreach ($values as $i => $value) {
            $key = "{$column}_notin_$i";
            $placeholders[] = ":$key";
            $this->bindings[$key] = $value;
        }
        $this->query .= " " . $this->quoteIdentifier($column) . " NOT IN (" . implode(", ", $placeholders) . ")";
        return $this;
    }
    
    public function whereNull($column) {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " IS NULL";
        return $this;
    }
    
    public function whereNotNull($column) {
        $this->addWhereClause();
        $this->query .= " " . $this->quoteIdentifier($column) . " IS NOT NULL";
        return $this;
    }
    
    public function first() {
        $this->limit(1);
        $result = $this->get();
        return $result[0] ?? null;
    }
    
    public function find($id, $primaryKey = 'id') {
        return $this->where($primaryKey, '=', $id)->first();
    }
    
    public function select($columns = ['*']) {
        $quoted = array_map([$this, 'quoteIdentifier'], $columns);
        $this->query = "SELECT " . implode(', ', $quoted) . " FROM " . $this->quoteIdentifier($this->table);
        return $this;
    }

    
    public function filter(array $conditions) {
        foreach ($conditions as $key => $condition) {
            if (is_string($key)) {
                if ($condition !== null) { // Skip if value is NULL
                    $this->where($key, '=', $condition);
                }
            } elseif (is_array($condition)) {
                if (count($condition) < 2) {
                    throw new InvalidArgumentException("Filter condition must have at least [column, operator, value].");
                }
    
                [$column, $operator, $value] = array_pad($condition, 3, null);
    
                switch (strtoupper($operator)) {
                    case 'IN':
                    case 'NOT IN':
                        if (!is_array($value) || empty($value)) {
                            throw new InvalidArgumentException("Value for IN/NOT IN must be a non-empty array.");
                        }
                        $placeholders = implode(', ', array_map(fn($k) => ":{$column}_$k", array_keys($value)));
                        $this->addWhereClause();
                        $this->query .= " {$this->quoteIdentifier($column)} $operator ($placeholders)";
                        foreach ($value as $index => $val) {
                            $this->bindings["{$column}_$index"] = $val;
                        }
                        break;
    
                    case 'BETWEEN':
                    case 'NOT BETWEEN':
                        if (!is_array($value) || count($value) !== 2) {
                            throw new InvalidArgumentException("Value for BETWEEN must be an array with exactly 2 elements.");
                        }
                        $this->addWhereClause();
                        $this->query .= " {$this->quoteIdentifier($column)} $operator :{$column}_start AND :{$column}_end";
                        $this->bindings["{$column}_start"] = $value[0];
                        $this->bindings["{$column}_end"] = $value[1];
                        break;
    
                    case 'IS NULL':
                    case 'IS NOT NULL':
                        $this->addWhereClause();
                        $this->query .= " {$this->quoteIdentifier($column)} $operator";
                        break;
    
                    default:
                        if ($value !== null) { // Skip if value is NULL
                            $this->where($column, $operator, $value);
                        }
                }
            }
        }
    
        // Debug log the query and bindings
        error_log("Filter Query: " . $this->toSql());
        error_log("Filter Bindings: " . json_encode($this->bindings));
    
        return $this;
    }
    
    

    // Sorting and Pagination
    public function orderBy($column, $direction = 'ASC') {
        $this->query .= " ORDER BY " . $this->quoteIdentifier($column) . " $direction";
        return $this;
    }

    public function paginate($page = 1, $perPage = 15) {
        $offset = ($page - 1) * $perPage;
        return $this->limit($perPage)->offset($offset);
    }

    public function limit($limit) {
        $this->query .= " LIMIT :limit";
        $this->bindings['limit'] = (int)$limit;
        return $this;
    }

    public function offset($offset) {
        $this->query .= " OFFSET :offset";
        $this->bindings['offset'] = (int)$offset;
        return $this;
    }

    public function count($column = '*') {
        // If a specific column is specified, quote it for safety
        if ($column !== '*') {
            $column = $this->quoteIdentifier($column);
        }
    
        // Save the original query and bindings
        $originalQuery = $this->query;
        $originalBindings = $this->bindings;
    
        try {
            // Start building the COUNT query
            $this->query = "SELECT COUNT($column) AS count FROM " . $this->quoteIdentifier($this->table);
    
            // Add WHERE clause if the original query had conditions
            if (stripos($originalQuery, 'WHERE') !== false) {
                $whereClause = substr($originalQuery, stripos($originalQuery, 'WHERE'));
                $this->query .= " " . $whereClause;
            }
    
            // Log the generated SQL and bindings for debugging
            error_log("Generated Count Query: " . $this->toSql());
            error_log("Count Query Bindings: " . json_encode($this->bindings));
    
            // Execute the query and fetch the result
            $result = $this->get();
            error_log("Count Query Result: " . json_encode($result)); // Debug the result
    
            return isset($result[0]->count) ? (int)$result[0]->count : 0;
        } catch (PDOException $e) {
            // Log any query execution errors
            error_log("Count Query Failed: " . $e->getMessage());
            throw new Exception("Failed to execute count query.");
        } finally {
            // Restore the original query and bindings
            $this->query = $originalQuery;
            $this->bindings = $originalBindings;
        }
    }
    
    




    public function sum($column) {
        $this->query = "SELECT SUM(" . $this->quoteIdentifier($column) . ") AS sum FROM " . $this->quoteIdentifier($this->table);
        // Add WHERE clause dynamically if conditions exist
        if (!empty($this->bindings)) {
            $this->query .= " WHERE";
            foreach ($this->bindings as $key => $value) {
                $this->query .= " " . $this->quoteIdentifier($key) . " = :$key AND";
            }
            $this->query = rtrim($this->query, 'AND'); // Remove trailing AND
        }
        return $this->get()[0]->sum ?? 0;
    }
    
    public function avg($column) {
        $this->query = "SELECT AVG(" . $this->quoteIdentifier($column) . ") AS avg FROM " . $this->quoteIdentifier($this->table);
        if (!empty($this->bindings)) {
            $this->query .= " WHERE";
            foreach ($this->bindings as $key => $value) {
                $this->query .= " " . $this->quoteIdentifier($key) . " = :$key AND";
            }
            $this->query = rtrim($this->query, 'AND');
        }
        return $this->get()[0]->avg ?? 0;
    }
    
    public function min($column) {
        $this->query = "SELECT MIN(" . $this->quoteIdentifier($column) . ") AS min FROM " . $this->quoteIdentifier($this->table);
        if (!empty($this->bindings)) {
            $this->query .= " WHERE";
            foreach ($this->bindings as $key => $value) {
                $this->query .= " " . $this->quoteIdentifier($key) . " = :$key AND";
            }
            $this->query = rtrim($this->query, 'AND');
        }
        return $this->get()[0]->min ?? 0;
    }
    
    public function max($column) {
        $this->query = "SELECT MAX(" . $this->quoteIdentifier($column) . ") AS max FROM " . $this->quoteIdentifier($this->table);
        if (!empty($this->bindings)) {
            $this->query .= " WHERE";
            foreach ($this->bindings as $key => $value) {
                $this->query .= " " . $this->quoteIdentifier($key) . " = :$key AND";
            }
            $this->query = rtrim($this->query, 'AND');
        }
        return $this->get()[0]->max ?? 0;
    }
    
    // Debugging and Utility
    public function toSql() {
        // Ensure $this->query exists before processing
        $query = $this->query ?? '';
    
        // Replace placeholders with their corresponding bound values
        foreach ($this->bindings as $key => $value) {
            // Escape single quotes in the value to prevent syntax issues
            $escapedValue = str_replace("'", "\\'", $value);
    
            // Use proper quoting for string and numeric values
            if (is_numeric($value)) {
                $query = str_replace(":$key", $value, $query);
            } else {
                $query = str_replace(":$key", "'$escapedValue'", $query);
            }
        }
    
        return $query;
    }
    
    public function logQuery($logFile = '../app/logs/query.log') {
        try {
            // Check if the log directory exists and create it if not
            $logDir = dirname($logFile);
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }
    
            // Prepare log entry
            $timestamp = date('[Y-m-d H:i:s]');
            $logData = $timestamp . " " . $this->toSql() . PHP_EOL;
    
            // Write the log data to the file
            file_put_contents($logFile, $logData, FILE_APPEND);
        } catch (Exception $e) {
            // Handle exceptions gracefully (e.g., log directory not writable)
            error_log("Failed to log query: " . $e->getMessage());
        }
    
        return $this; // Allow chaining
    }
    

    // Execution
    public function get() {
        $stmt = $this->db->prepare($this->query);
        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":$key", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function execute() {
        $stmt = $this->db->prepare($this->query);
        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":$key", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        return $stmt->execute();
    }

    // Helper Methods
    protected function addWhereClause() {
        if (!$this->whereAdded) {
            $this->query .= " WHERE";
            $this->whereAdded = true;
        } else {
            $this->query .= " AND";
        }
    }

    private function quoteIdentifier($identifier) {
        $parts = explode('.', $identifier);
        foreach ($parts as &$part) {
            $part = "`" . str_replace("`", "``", $part) . "`";
        }
        return implode('.', $parts);
    }
}
