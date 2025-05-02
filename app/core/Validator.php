<?php

class Validator {
    private $errors = [];
    private $rules = [];
    private $data = [];
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Adjust if needed
    }

    public function rules(array $rules) {
        $this->rules = $rules;
    }

    public function validate(array $data) {
        $this->data = $data;

        foreach ($this->rules as $field => $ruleString) {
            if ($ruleString === '') continue;

            $rules = explode('|', $ruleString);
            $value = $data[$field] ?? null;

            if (in_array('nullable', $rules) && ($value === null || $value === '')) {
                continue;
            }

            foreach ($rules as $rule) {
                $parts = explode(':', $rule);
                $ruleName = $parts[0];
                $param = $parts[1] ?? null;

                if (method_exists($this, $ruleName)) {
                    $this->{$ruleName}($field, $value, $param);
                }
            }
        }
    }

    private function required($field, $value) {
        if ($value === null || $value === '') {
            $this->errors[$field] = "The $field field is required.";
        }
    }

    private function min($field, $value, $param) {
        if (strlen((string)$value) < (int)$param) {
            $this->errors[$field] = "The $field must be at least $param characters.";
        }
    }

    private function max($field, $value, $param) {
        if (strlen((string)$value) > (int)$param) {
            $this->errors[$field] = "The $field may not be greater than $param characters.";
        }
    }

    private function numeric($field, $value) {
        if (!is_numeric($value)) {
            $this->errors[$field] = "The $field must be a number.";
        }
    }

    private function email($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "The $field must be a valid email address.";
        }
    }

    private function in($field, $value, $param) {
        $allowed = explode(',', $param);
        if (!in_array($value, $allowed)) {
            $this->errors[$field] = "The $field must be one of: " . implode(', ', $allowed);
        }
    }

    private function file($field, $value) {
        if (!is_string($value) || strpos($value, '.') === false) {
            $this->errors[$field] = "The $field must be a valid file name.";
        }
    }

    private function image($field, $value) {
        $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $this->errors[$field] = "The $field must be an image (jpg, jpeg, png, gif).";
        }
    }

    private function unique($field, $value, $param = null) {
        [$table, $column] = explode(',', $param ?? "$field,$field");
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = :val");
        $stmt->execute(['val' => $value]);
        if ($stmt->fetchColumn() > 0) {
            $this->errors[$field] = "The $field must be unique.";
        }
    }

    private function exists($field, $value, $param = null) {
        [$table, $column] = explode(',', $param ?? "$field,$field");
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = :val");
        $stmt->execute(['val' => $value]);
        if ($stmt->fetchColumn() == 0) {
            $this->errors[$field] = "The $field does not exist.";
        }
    }

    private function nullable($field, $value, $param = null) {
        // already handled in validate()
    }

    public function fails(): bool {
        return !empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}


// $rules = array(
//     'productName'       => 'required|max:100|unique:products,productName',
//     'price'             => 'required|min:1|numeric',
//     'stockQuantity'     => 'required|min:0|numeric',
//     'productType'       => 'required|in:physical,digital,service',
//     'status'            => 'required|in:active,inactive',
//     'categoryId'        => 'required|exists:categories,categoryId',
//     'productImage'      => 'file|nullable',
//     'productCreatedAt'  => '',
//     'productUpdatedAt'  => '',
//     'productIdentify'   => 'required|max:50'
// );
