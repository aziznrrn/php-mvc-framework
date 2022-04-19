<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';

    public array $errors = [];

    public function addError(string $field, string $rule, string $message): void
    {
        $this->errors[$field][$rule] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasError(string $field): bool
    {
        return isset($this->errors[$field]);
    }

    public function getFirstError(string $field): string
    {
        if ($this->hasError($field)) {
            return $this->errors[$field][array_keys($this->errors[$field])[0]];
        }

        return '';
    }

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $key => $rules) {
            foreach ($rules as $rule => $ruleValue) {
                if ($rule === self::RULE_REQUIRED && empty($this->$key)) {
                    $this->addError($key, $rule, 'This field is required');
                }

                if ($rule === self::RULE_MIN && mb_strlen($this->$key) < $ruleValue) {
                    $this->addError($key, $rule, 'Min length is ' . $ruleValue);
                }

                if ($rule === self::RULE_MAX && mb_strlen($this->$key) > $ruleValue) {
                    $this->addError($key, $rule, 'Max length is '.$ruleValue);
                }

                if ($rule === self::RULE_EMAIL && !filter_var($this->$key, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($key, $rule, 'Email is not valid');
                }

                if ($rule === self::RULE_MATCH && $this->$key !== $this->$ruleValue) {
                    $this->addError($key, $rule, 'This field not match with ' . $ruleValue);
                }
            }
        }

        return empty($this->errors);
    }


    public function save()
    {
        return true;
    }

    abstract function rules(): array;
}