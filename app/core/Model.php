<?php

/**
 * CoreXPHP Base Model Class
 * 
 * Base model providing CRUD, relationships, search, filtering, pagination, etc.
 */
class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $db;
    protected $query;
    protected array $attributes = []; // Store fields here
    protected array $columns = [];    // All columns
    protected array $fields = [];     // Fields allowed for create/update
    protected array $filters = [];    // Fields allowed for search
    protected array $guarded = [];    // Dynamic and manual guarded fields
    protected bool $fieldsPrepared = false;
    protected $orders = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        if (!$this->table) {
            throw new Exception("Model table is not defined in class: " . static::class);
        }

        $this->query = QueryBuilder::table($this->table);
    }

    public function findAll(array $options = [])
{
    $this->prepareFields();
    $query = QueryBuilder::table($this->table);

    // Filters
    if (!empty($options['filters'])) {
        foreach ($options['filters'] as $column => $value) {
            if (in_array($column, $this->columns)) {
                $query->where($column, '=', $value);
            }
        }
    }

    // Search
    if (!empty($options['search'])) {
        $term = $options['search']['term'] ?? '';
        $columns = $options['search']['columns'] ?? [];

        if (!empty($term) && !empty($columns)) {
            $query->where(function ($q) use ($term, $columns) {
                foreach ($columns as $i => $column) {
                    $i === 0
                        ? $q->where($column, 'LIKE', "%$term%")
                        : $q->orWhere($column, 'LIKE', "%$term%");
                }
            });
        }
    }

    // Sorting
    if (!empty($options['sort'])) {
        $query->orderBy(
            $options['sort']['column'],
            $options['sort']['direction'] ?? 'asc'
        );
    }

    // Pagination — just return builder with paginate called
    if (!empty($options['pagination']) && $options['pagination']['enabled']) {
        $page = max(1, (int)($options['pagination']['page'] ?? 1));
        $perPage = max(1, (int)($options['pagination']['perPage'] ?? 10));
        $query->paginate($page, $perPage);
    }

    return $query; // Always return builder
}

    
        // Forward the whereRaw call to the QueryBuilder instance
        public function whereRaw($sql)
        {
            $this->query->whereRaw($sql);
            return $this;
        }

    // --- Prepare Fields ---

    protected function prepareFields()
    {
        if ($this->fieldsPrepared) return $this->fields;

        $stmt = $this->db->prepare("SHOW COLUMNS FROM {$this->table}");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($columns as $column) {
            $fieldName = $column['Field'];
            $fieldType = strtolower($column['Type']);

            $this->columns[] = $fieldName;

            // Guard fields that end with 'id'
            if (preg_match('/id$/i', $fieldName)) {
                $this->guarded[] = $fieldName;
            }

            if (!in_array($fieldName, $this->guarded)) {
                $this->fields[] = $fieldName;
            }

            if (strpos($fieldType, 'varchar') !== false || strpos($fieldType, 'text') !== false || strpos($fieldType, 'enum') !== false) {
                $this->filters[] = $fieldName;
            }
        }

        $this->fieldsPrepared = true;
        return $this->fields;
    }

    // --- Magic Methods ---

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    // --- Core CRUD ---

    public function create($data)
    {
        $data = array_intersect_key($data, array_flip(array_diff($this->prepareFields(), $this->guarded)));
        return $this->query->insert($data);
    }

    public function find($id)
    {
        $row = QueryBuilder::table($this->table)->where($this->primaryKey, '=', $id)->first();

        if (!$row) {
            return null;
        }

        $model = new static();
        $model->fill(get_object_vars($row));
        return $model;
    }

    public function update($data, $id)
    {
        $data = array_intersect_key($data, array_flip(array_diff($this->prepareFields(), $this->guarded)));
        return $this->query->where($this->primaryKey, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->query->where($this->primaryKey, '=', $id)->delete();
    }

    public function truncate()
    {
        return $this->db->exec("TRUNCATE TABLE {$this->table}");
    }

    public function save()
    {
        if (isset($this->attributes[$this->primaryKey])) {
            return $this->update($this->attributes, $this->attributes[$this->primaryKey]);
        } else {
            return $this->create($this->attributes);
        }
    }

    // --- Query Builder Wrappers ---

    public function filter($conditions)
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
    

    public function search($term, $columns)
    {
        $this->where(function ($query) use ($term, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $term . '%');
            }
        });
        return $this;
    }

    public function orderBy($column, $direction = 'desc')
    {
        $this->query->orderBy($column, $direction);
        return $this;
    }

    public function paginate($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $this->limit($perPage)->offset($offset);

        $data = $this->get();
        $total = $this->count();
        $totalPages = ceil($total / $perPage);

        return [
            'data' => $data,
            'meta' => [
                'total'       => $total,
                'totalPages'  => $totalPages,
                'currentPage' => $page,
                'perPage'     => $perPage,
            ],
        ];
    }

    public function select($columns)
    {
        $this->query->select($columns);
        return $this;
    }

    public function all()
    {
        $rows = $this->query->get();

        $models = [];
        foreach ($rows as $row) {
            $model = new static();
            $model->fill(get_object_vars($row));
            $models[] = $model;
        }

        return $models;
    }

    // public function findAll(array $options = [])
    // {
    //     $this->prepareFields(); // Ensure fields are prepared before anything else
        
    //     // Apply filters
    //     if (isset($options['filters']) && is_array($options['filters'])) {
    //         foreach ($options['filters'] as $column => $value) {
    //             if (in_array($column, $this->columns)) {
    //                 // Apply filter with 3 arguments (column, '=', value)
    //                 $this->where($column, '=', $value); 
    //             }
    //         }
    //     }
        
    //     // Apply search
    //     if (isset($options['search']) && is_array($options['search'])) {
    //         $term = $options['search']['term'] ?? null;
    //         $columns = $options['search']['columns'] ?? $this->filters;
    
    //         if ($term) {
    //             // Prepare search conditions as raw SQL
    //             $searchConditions = [];
    //             foreach ($columns as $column) {
    //                 if (in_array($column, $this->columns)) {
    //                     // Add LIKE condition for each column
    //                     $searchConditions[] = "{$column} LIKE '%" . $term . "%'";
    //                 }
    //             }
    
    //             // If there are conditions, join them with OR and apply raw where
    //             if (!empty($searchConditions)) {
    //                 $this->whereRaw(implode(' OR ', $searchConditions));
    //             }
    //         }
    //     }
    
    //     // Apply sort
    //     if (isset($options['sort']) && isset($options['sort']['column'])) {
    //         $direction = $options['sort']['direction'] ?? 'desc';
    //         $this->orderBy($options['sort']['column'], $direction);
    //     }
    
    //     // Apply pagination last to ensure it's applied after all conditions
    //     if (isset($options['pagination']) && $options['pagination']['enabled']) {
    //         $page = $options['pagination']['page'] ?? 1;
    //         $perPage = $options['pagination']['perPage'] ?? 10;
    
    //         // Ensure pagination is applied last so it's based on the final query
    //         return $this->paginate($page, $perPage);  // Pagination method call
    //     }
        
    //     // If pagination not enabled, return the builder (normal query)
    //     return $this;
    // }
    
    

    public function first()
    {
        $row = $this->query->first();

        if (!$row) {
            return null;
        }

        $model = new static();
        $model->fill(get_object_vars($row));
        return $model;
    }

    public function where($column, $operator = null, $value = null)
    {
        if (is_callable($column)) {
            $this->query->where($column); // pass closure directly to QueryBuilder
            return $this;
        }
    
        $this->query->where($column, $operator, $value);
        return $this;
    }
    

    public function whereIn($column, $values)
    {
        $this->query->whereIn($column, $values);
        return $this;
    }

    public function whereNull($column)
    {
        $this->query->whereNull($column);
        return $this;
    }

    public function whereNotNull($column)
    {
        $this->query->whereNotNull($column);
        return $this;
    }

    public function limit($limit)
    {
        $this->query->limit($limit);
        return $this;
    }

    public function offset($offset)
    {
        $this->query->offset($offset);
        return $this;
    }

    public function get()
    {
        $rows = $this->query->get();

        $models = [];
        foreach ($rows as $row) {
            $model = new static();
            $model->fill(get_object_vars($row));
            $models[] = $model;
        }

        return $models;
    }

    public function count()
    {
        return $this->query->count();
    }

    // --- Helper Methods ---

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function toSql(): string
    {
        return $this->query->toSql();
    }

    public function logQuery(): void
    {
        $sql = $this->toSql();
        $logFile = __DIR__ . '/queries.log';
        file_put_contents($logFile, $sql . PHP_EOL, FILE_APPEND);
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    // --- Internal Auto-Loader for Related Models ---

    protected function loadModelIfNotExists($modelClass)
    {
        if (!class_exists($modelClass)) {
            $modelPath = "../app/models/" . $modelClass . ".php";

            if (file_exists($modelPath)) {
                require_once $modelPath;
            } else {
                throw new Exception("Related model $modelClass not found at $modelPath");
            }
        }
    }

    // --- Relationship Methods with Autoloading ---

    public function hasOne($relatedModel, $foreignKey, $localKey = null)
    {
        $this->loadModelIfNotExists($relatedModel);

        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedModel;
        return $related->where($foreignKey, '=', $this->{$localKey})->first();
    }

    public function hasMany($relatedModel, $foreignKey, $localKey = null)
    {
        $this->loadModelIfNotExists($relatedModel);

        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedModel;
        return $related->where($foreignKey, '=', $this->{$localKey})->all();
    }

    public function belongsTo($relatedModel, $foreignKey, $ownerKey = 'id')
    {
        $this->loadModelIfNotExists($relatedModel);

        $related = new $relatedModel;
        return $related->where($ownerKey, '=', $this->{$foreignKey})->first();
    }

    public function belongsToMany($relatedModel, $pivotTable, $foreignPivotKey, $relatedPivotKey, $localKey = null)
    {
        $this->loadModelIfNotExists($relatedModel);

        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedModel;
        $relatedTable = $related->getTable();

        $sql = "
            SELECT $relatedTable.*
            FROM $relatedTable
            JOIN $pivotTable ON $pivotTable.$relatedPivotKey = $relatedTable.{$related->getPrimaryKey()}
            WHERE $pivotTable.$foreignPivotKey = :foreignId
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['foreignId' => $this->{$localKey}]);

        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

        $models = [];
        foreach ($rows as $row) {
            $model = new $relatedModel();
            $model->fill(get_object_vars($row));
            $models[] = $model;
        }

        return $models;
    }

    public function morphMany($relatedModel, $morphType, $morphId)
    {
        $this->loadModelIfNotExists($relatedModel);

        $related = new $relatedModel;
        return $related->where($morphType, '=', static::class)
            ->where($morphId, '=', $this->{$this->primaryKey})
            ->all();
    }

    public function morphTo($typeField, $idField)
    {
        $relatedClass = $this->{$typeField};
        $relatedId = $this->{$idField};

        if (!class_exists($relatedClass)) {
            $this->loadModelIfNotExists($relatedClass);
        }

        if (!class_exists($relatedClass)) {
            return null;
        }

        $related = new $relatedClass;
        return $related->find($relatedId);
    }
}
