<?php

/**
 * CoreXPHP Base Model Class
 * 
 * This is the base model every other model should extend.
 * It provides CRUD operations, relationship handling, search, filtering, pagination, etc.
 */
class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $db;
    protected $query;
    protected $orders = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->query = new QueryBuilder($this->db, $this->table);
    }

    /** Create a new record */
    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /** Find by primary key */
    public function find($id)
    {
        return $this->db->select($this->table, '*')->where($this->primaryKey, '=', $id)->first();
    }

    /** Update a record by ID */
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data)->where($this->primaryKey, '=', $id);
    }

    /** Delete a record by ID */
    public function delete($id)
    {
        return $this->db->delete($this->table)->where($this->primaryKey, '=', $id);
    }

    /** Truncate the entire table */
    public function truncate()
    {
        return $this->db->truncate($this->table);
    }

    /** Save the current model (insert or update based on primaryKey presence) */
    public function save()
    {
        if (isset($this->{$this->primaryKey})) {
            return $this->update(get_object_vars($this), $this->{$this->primaryKey});
        } else {
            return $this->create(get_object_vars($this));
        }
    }

    /** Apply dynamic filters */
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

    /** Search across multiple columns */
    public function search($term, $columns)
    {
        $this->where(function ($query) use ($term, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $term . '%');
            }
        });
        return $this;
    }

    /** Add orderBy clause */
    public function orderBy($column, $direction = 'desc')
    {
        $this->orders[] = [$column, strtoupper($direction)];
        return $this;
    }

    /** Paginate results */
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

    /** Select columns */
    public function select($columns)
    {
        $this->query->select($columns);
        return $this;
    }

    /** Get all records */
    public function all()
    {
        return $this->db->select($this->table, '*')->get();
    }

    /** Get the first record */
    public function first()
    {
        return $this->db->select($this->table, '*')->first();
    }

    /** Add where clause */
    public function where($column, $operator, $value)
    {
        $this->query->where($column, $operator, $value);
        return $this;
    }

    /** Where IN */
    public function whereIn($column, $values)
    {
        $this->query->whereIn($column, $values);
        return $this;
    }

    /** Where NULL */
    public function whereNull($column)
    {
        $this->query->whereNull($column);
        return $this;
    }

    /** Where NOT NULL */
    public function whereNotNull($column)
    {
        $this->query->whereNotNull($column);
        return $this;
    }

    /** Limit results */
    public function limit($limit)
    {
        $this->query->limit($limit);
        return $this;
    }

    /** Offset results */
    public function offset($offset)
    {
        $this->query->offset($offset);
        return $this;
    }

    /** Get query results */
    public function get()
    {
        return $this->query->get();
    }

    /** Count results */
    public function count()
    {
        return $this->query->count();
    }

    /** Convert model to array */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /** Convert model to JSON */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /** Get raw SQL */
    public function toSql(): string
    {
        return $this->query->toSql();
    }

    /** Log query to file */
    public function logQuery(): void
    {
        $sql = $this->toSql();
        $logFile = __DIR__ . '/queries.log';
        file_put_contents($logFile, $sql . PHP_EOL, FILE_APPEND);
    }

    /** Get table name */
    public function getTable(): string
    {
        return $this->table;
    }

    /** Get primary key name */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    /** Cast attributes (optional) */
    public function castAttributes($row)
    {
        // You can add logic for type casting here.
    }

    /** One-to-One relation */
    public function hasOne($relatedModel, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedModel;
        return $related->where($foreignKey, '=', $this->{$localKey})->first();
    }

    /** One-to-Many relation */
    public function hasMany($relatedModel, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?? $this->primaryKey;
        $related = new $relatedModel;
        return $related->where($foreignKey, '=', $this->{$localKey})->all();
    }

    /** BelongsTo (inverse of hasOne) */
    public function belongsTo($relatedModel, $foreignKey, $ownerKey = 'id')
    {
        $related = new $relatedModel;
        return $related->where($ownerKey, '=', $this->{$foreignKey})->first();
    }

    /** Many-to-Many */
    public function belongsToMany($relatedModel, $pivotTable, $foreignPivotKey, $relatedPivotKey, $localKey = null)
    {
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** MorphMany Polymorphic */
    public function morphMany($relatedModel, $morphType, $morphId)
    {
        $related = new $relatedModel;
        return $related->where($morphType, '=', static::class)
            ->where($morphId, '=', $this->{$this->primaryKey})
            ->all();
    }

    /** MorphTo Polymorphic */
    public function morphTo($typeField, $idField)
    {
        $relatedClass = $this->{$typeField};
        $relatedId = $this->{$idField};

        if (!class_exists($relatedClass)) return null;

        $related = new $relatedClass;
        return $related->find($relatedId);
    }
}
