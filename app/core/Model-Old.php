<?php
abstract class Model{
    private $db; 
    protected $table;

    // Constructor to initialize database connection
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get the table name associated with the model
    // Usage: $model->getTable();
    public function getTable() {
        return $this->table;
    }

    // Get a new QueryBuilder instance for the model's table
    // Usage: $model->query()->select('*')->where('id', 1)->get();
    public function query() {
        return (new QueryBuilder())->table($this->getTable());
    }

    // Define a one-to-many relationship
    // Usage: $model->hasMany(RelatedModel::class, 'foreign_key');
    public function hasMany($related, $foreignKey, $localKey = 'id') {
        $instance = new $related;
        $sql = "SELECT * FROM `{$instance->table}` WHERE `$foreignKey` = :localKey";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['localKey' => $this->$localKey]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Define a many-to-many relationship
    // Usage: $model->belongsToMany(RelatedModel::class, 'pivot_table', 'foreign_key', 'related_key');
    public function belongsToMany($related, $pivotTable, $foreignKey, $relatedKey, $localKey = 'id', $relatedLocalKey = 'id') {
        $instance = new $related;
        $sql = "SELECT `{$instance->table}`.* FROM `{$instance->table}`
                JOIN `$pivotTable` ON `$pivotTable`.`$relatedKey` = `{$instance->table}`.`$relatedLocalKey`
                WHERE `$pivotTable`.`$foreignKey` = :localKey";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['localKey' => $this->$localKey]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Define a polymorphic one-to-many relationship
    // Usage: $model->morphMany(RelatedModel::class, 'morph_type', 'morph_id', 'type');
    public function morphMany($related, $morphType, $morphId, $type) {
        $instance = new $related;
        $sql = "SELECT * FROM `{$instance->getTable()}` WHERE `$morphType` = :type AND `$morphId` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['type' => $type, 'id' => $this->$morphId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    // Define a polymorphic inverse relationship
    // Usage: $model->morphTo('morph_type', 'morph_id');
    public function morphTo($morphType, $morphId) {
        $type = $this->$morphType;
        $id = $this->$morphId;
        $instance = new $type;
        $sql = "SELECT * FROM `{$instance->table}` WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Retrieve a single record from a specified table
    // Usage: $model->single('table_name', ['column1', 'column2'], ['id' => 1]);
    public function single($tableName, $columns = [], $where = []) {
        $sql = "SELECT ";
    
        if ($columns) {
            foreach ($columns as $column) {
                $sql .= "`" . $column . "`, ";
            }
            $sql = rtrim($sql, ", ");
        } else {
            $sql .= "*";
        }
    
        $sql .= " FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $sql .= " LIMIT 1";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetch();
    }

    // Count the number of records in a specified table
    // Usage: $model->count('table_name', ['column' => 'value']);
    public function count($tableName, $where = []) {
        $sql = "SELECT COUNT(*) as total FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        $result = $stmt->fetch();
        return $result['total'];
    }

    // Insert a new record into a specified table
    // Usage: $model->insert('table_name', ['column1' => 'value1', 'column2' => 'value2']);
    public function insert($tableName, $data) {
        $keys = array_keys($data);
        $values = array_values($data);
        $sql = "INSERT INTO `" . $tableName . "` (`";
        $sql .= implode("`, `", $keys);
        $sql .= "`) VALUES ('";
        $sql .= implode("', '", $values);
        $sql .= "')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    // Insert a new record into a specified table with conditions
    // Usage: $model->insertWhere('table_name', ['column1' => 'value1'], ['condition_column' => 'value']);
    public function insertWhere($tableName, $data, $where = []) {
        $keys = array_keys($data);
        $values = array_values($data);
    
        $sql = "INSERT INTO `" . $tableName . "` (`";
        $sql .= implode("`, `", $keys);
        $sql .= "`) VALUES ('";
        $sql .= implode("', '", $values);
        $sql .= "')";
    
        if (!empty($where)) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= $key . " = '" . $value . "' AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    // Update records in a specified table
    // Usage: $model->update('table_name', ['column' => 'value'], 'id = 1');
    public function update($tableName, $data, $where = null) {
        $sql = "UPDATE `" . $tableName . "` SET ";
        $placeholders = [];
        
        foreach ($data as $key => $value) {
            $placeholders[] = "`" . $key . "` = :" . $key;
        }
        $sql .= implode(", ", $placeholders);
        
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        
        $stmt->execute();
    }
    


    // Delete records from a specified table
    // Usage: $model->delete('table_name', 'id = 1');
    public function delete($tableName, $where = null) {
        $sql = "DELETE FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE " . $where;
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    // Delete records from a specified table with conditions
    // Usage: $model->deleteWhere('table_name', ['column' => 'value']);
    public function deleteWhere($tableName, $where = []) {
        $sql = "DELETE FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
    }

    // Select records from a specified table
    // Usage: $model->select('table_name', ['column1', 'column2'], ['column' => 'value']);
    public function select($tableName, $columns = [], $where = []) {
        $sql = "SELECT ";
    
        if ($columns) {
            foreach ($columns as $column) {
                $sql .= "`" . $column . "`, ";
            }
            $sql = rtrim($sql, ", ");
        } else {
            $sql .= "*";
        }
    
        $sql .= " FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    // Paginate records from a specified table
    // Usage: $model->paginate('table_name', ['column1', 'column2'], ['column' => 'value'], 1, 10);
    public function paginate($tableName, $columns = [], $where = [], $offset = 1, $perPage = 10) {
        $sql = "SELECT ";
    
        if ($columns) {
            foreach ($columns as $column) {
                $sql .= "`" . $column . "`, ";
            }
            $sql = rtrim($sql, ", ");
        } else {
            $sql .= "*";
        }
    
        $sql .= " FROM `" . $tableName . "`";
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $sql .= " LIMIT " . (int)$offset . ", " . (int)$perPage;
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    // Search records in a specified table
    // Usage: $model->search('table_name', ['column1', 'column2'], ['column' => 'value'], 'search_term', ['search_column'], 1, 10);
    public function search($tableName, $columns = [], $where = [], $search = '', $searchColumns = [], $offset = 1, $perPage = 10) {
        $sql = "SELECT ";
    
        if ($columns) {
            foreach ($columns as $column) {
                $sql .= "`" . $column . "`, ";
            }
            $sql = rtrim($sql, ", ");
        } else {
            $sql .= "*";
        }
    
        $sql .= " FROM `" . $tableName . "`";
    
        if ($where || $search) {
            $sql .= " WHERE ";
            if ($where) {
                foreach ($where as $key => $value) {
                    $sql .= "`" . $key . "` = :" . $key . " AND ";
                }
            }
            if ($search) {
                $sql .= " (";
                foreach ($searchColumns as $column) {
                    $sql .= "`" . $column . "` LIKE :search OR ";
                }
                $sql = rtrim($sql, " OR ");
                $sql .= ") AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $sql .= " LIMIT " . (int)$offset . ", " . (int)$perPage;
    
        $stmt = $this->db->prepare($sql);
        $params = $where;
        if ($search) {
            $search = '%' . $search . '%';
            foreach ($searchColumns as $column) {
                $params['search'] = $search;
            }
        }
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Count the number of search results in a specified table
    // Usage: $model->searchCount('table_name', 'search_term', ['search_column']);
    public function searchCount($tableName, $search, $searchColumns) {
        $query = "SELECT COUNT(*) as total FROM `" . $tableName . "` WHERE 1=1";
        $params = array();
    
        if (!empty($search) && !empty($searchColumns)) {
            $query .= " AND (";
            $first = true;
            foreach ($searchColumns as $column) {
                if ($first) {
                    $query .= "`$column` LIKE ?";
                    $first = false;
                } else {
                    $query .= " OR `$column` LIKE ?";
                }
                $params[] = "%$search%";
            }
            $query .= ")";
        }
    
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['total']) ? $result['total'] : 0;
    }

    // Perform a join operation on specified tables
    // Usage: $model->join('table_name', ['table1.column1', 'table2.column2'], [['table' => 'join_table', 'on' => 'table1.id = join_table.table1_id']], ['column' => 'value']);
    public function join($tableName, $columns, $join = [], $where = []) {
        $sql = "SELECT " . implode(", ", $columns) . " FROM `" . $tableName . "`";
    
        if ($join) {
            foreach ($join as $j) {
                $sql .= " LEFT JOIN " . $j['table'] . " ON " . $j['on'];
            }
        }
    
        if ($where) {
            $sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $sql .= "`" . $key . "` = :" . $key . " AND ";
            }
            $sql = rtrim($sql, " AND ");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll();
    }

    // Update records in a specified table with conditions
    // Usage: $model->updateWhere('table_name', ['column' => 'value'], ['condition_column' => 'value']);
    public function updateWhere($tableName, $data, $where = []) {
        $sql = "UPDATE `" . $tableName . "` SET ";
        $placeholders = [];
        
        foreach ($data as $key => $value) {
            $placeholders[] = "`" . $key . "` = :" . $key;
        }
        $sql .= implode(", ", $placeholders);
        
        if ($where) {
            $sql .= " WHERE ";
            $wherePlaceholders = [];
            
            foreach ($where as $key => $value) {
                $wherePlaceholders[] = "`" . $key . "` = :w_" . $key;
            }
            $sql .= implode(" AND ", $wherePlaceholders);
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        
        foreach ($where as $key => $value) {
            $stmt->bindValue(":w_" . $key, $value);
        }
        
        $stmt->execute();
    }
}
?>
