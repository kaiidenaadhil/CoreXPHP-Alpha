<?php 
class Validator {
    private $errors = [];
    private $rules = [];
    public function rules($rules) {
        $this->rules = $rules;
    }
    public function validate($data) {
        foreach ($this->rules as $field => $fieldRules) {
            $rules = explode('|', $fieldRules);
            foreach ($rules as $rule) {
                $value = isset($data[$field]) ? $data[$field] : null;
                $ruleData = explode(":", $rule);
                $rule = $ruleData[0];
                $param = isset($ruleData[1]) ? $ruleData[1] : null;
                $this->{$rule}($field, $value, $param);
            }
        }
    }
    private function required($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = "The $field field is required.";
        }
    }
    private function email($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "The $field field must be a valid email address.";
        }
    }
    private function min($field, $value, $param) {
        if (strlen($value) < $param) {
            $this->errors[$field] = "The $field field must be at least $param characters long.";
        }
    }
    public function fails() {
        return !empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }
}