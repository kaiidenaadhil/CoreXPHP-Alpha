<?php
class SchemaBuilder
{
    protected $table;
    protected $columns;
    protected static $globalSchema = [];

    public function createTable($tableName, &$columns)
    {
        $this->table = $tableName;
        $this->columns = &$columns;

        // Register globally to allow foreign key compatibility check
        self::$globalSchema[$tableName] = &$this->columns;

        $sql = "CREATE TABLE `$tableName` (\n";

        $columnSqls = [];
        $foreignKeys = [];

        foreach ($this->columns as $name => &$rules) {
            // Check and enforce FK compatibility
            if (strpos($rules, 'foreign') !== false) {
                $this->ensureCompatibleForeignKey($rules, $name);
            }

            $dataType = $this->getDataTypeFromRules($rules, $name);
            $columnSql = "`$name` $dataType";

            $additionalRules = $this->getAdditionalRules($rules, $name);
            $columnSql .= " $additionalRules";

            if (strpos($rules, 'foreign') !== false) {
                $foreignKey = $this->getForeignKeyFromRules($rules, $name);
                if ($foreignKey) {
                    $foreignKeys[] = $foreignKey;
                }
            }

            $columnSqls[] = trim($columnSql);
        }

        $allSqls = array_merge($columnSqls, $foreignKeys);
        $sql .= implode(",\n", $allSqls);
        $sql .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        return $sql;
    }

    protected function getDataTypeFromRules($rules, $name)
    {

        
        if (strpos($rules, 'timestamp') !== false) {
            return 'TIMESTAMP';
        }

        if (strpos($rules, 'enum:') !== false) {
            preg_match('/enum:([a-zA-Z0-9_,]+)/', $rules, $matches);
            $values = explode(',', $matches[1]);
            $quotedValues = array_map(fn($v) => "'$v'", $values);
            return 'ENUM(' . implode(', ', $quotedValues) . ')';
        }

        if (strpos($rules, 'boolean') !== false) {
            return 'BOOLEAN'; // BOOLEAN stores 0 or 1 in MySQL
        }

        if (strpos($rules, 'float') !== false) {
            preg_match('/float:(\d+),(\d+)/', $rules, $matches);
            if ($matches) {
                return "FLOAT({$matches[1]},{$matches[2]})"; // Handle precision for float
            }
            return 'FLOAT';
        }

        if (strpos($rules, 'decimal') !== false) {
            preg_match('/decimal:(\d+),(\d+)/', $rules, $matches);
            if ($matches) {
                return "DECIMAL({$matches[1]},{$matches[2]})"; // Handle precision for decimal
            }
            return 'DECIMAL';
        }

        if (strpos($rules, 'double') !== false) {
            preg_match('/double:(\d+),(\d+)/', $rules, $matches);
            if ($matches) {
                return "DOUBLE({$matches[1]},{$matches[2]})"; // Handle precision for double
            }
            return 'DOUBLE';
        }

        if (strpos($rules, 'unsigned') !== false) {
            return 'INT UNSIGNED';
        }

        if (strpos($rules, 'integer') !== false) {
            return 'INT';
        }

        if (strpos($rules, 'string') !== false) {
            if (preg_match('/max:(\d+)/', $rules, $matches)) {
                return "VARCHAR({$matches[1]})";
            }
            return 'VARCHAR(255)';
        }

         // If the rule contains 'file', we just return 'VARCHAR(255)'
        if (strpos($rules, 'file') !== false) {
            return 'VARCHAR(255)';
        }

        if (strpos($rules, 'text') !== false) {
            return 'TEXT';
        }

        return 'VARCHAR(255)';
    }

    protected function getAdditionalRules($rules, $name)
    {
        $sql = '';

        if (strpos($rules, 'timestamp') !== false) {
            if (preg_match('/CreatedAt$/i', $name)) {
                return ' NOT NULL DEFAULT CURRENT_TIMESTAMP';
            } elseif (preg_match('/UpdatedAt$/i', $name)) {
                return ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
            } else {
                return ' NULL';
            }
        }

        if (strpos($rules, 'primary_key') !== false) {
            $sql .= ' PRIMARY KEY';
        }

        if (strpos($rules, 'unique') !== false) {
            $sql .= ' UNIQUE';
        }

        $sql .= (strpos($rules, 'nullable') !== false) ? ' NULL' : ' NOT NULL';

        if (strpos($rules, 'auto_increment') !== false) {
            $sql .= ' AUTO_INCREMENT';
        }

        if (preg_match('/min:(\d+)/', $rules, $min)) {
            $sql .= " CHECK (`$name` >= {$min[1]})";
        }

        if (preg_match('/max:(\d+)/', $rules, $max)) {
            if (strpos($rules, 'integer') !== false) {
                $sql .= " CHECK (`$name` <= {$max[1]})";
            }
        }

        return $sql;
    }

    protected function getForeignKeyFromRules($rules, $name)
    {
        if (preg_match('/foreign:([a-zA-Z_]+):([a-zA-Z_]+)/', $rules, $matches)) {
            $refTable = $matches[1];
            $refColumn = $matches[2];
            return "FOREIGN KEY (`$name`) REFERENCES `$refTable`(`$refColumn`) ON DELETE CASCADE ON UPDATE CASCADE";
        }
        return null;
    }

    protected function ensureCompatibleForeignKey(&$rules, $name)
    {
        if (preg_match('/foreign:([a-zA-Z_]+):([a-zA-Z_]+)/', $rules, $matches)) {
            $refTable = $matches[1];
            $refColumn = $matches[2];

            // If referenced table/column exists in globalSchema, patch it
            if (isset(self::$globalSchema[$refTable][$refColumn])) {
                $refRules = &self::$globalSchema[$refTable][$refColumn];

                // Add integer type
                if (!str_contains($refRules, 'integer')) {
                    $refRules = 'integer|' . $refRules;
                }

                // Add unsigned
                if (!str_contains($refRules, 'unsigned')) {
                    $refRules .= '|unsigned';
                }

                // Add PK/Unique if missing
                if (!str_contains($refRules, 'primary_key') && !str_contains($refRules, 'unique')) {
                    $refRules .= '|primary_key';
                }

                // Also update the local side
                if (!str_contains($rules, 'unsigned')) {
                    $rules .= '|unsigned';
                }
            }
        }
    }
}
