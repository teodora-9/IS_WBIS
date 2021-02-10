<?php


namespace app\core;


abstract class Model
{
    public const RULE_EMAIL = 'email';
    public const RULE_EMAIL_UNIQUE = 'emailUnique';
    public const RULE_REQUIRED = 'required';
    public const RULE_MATCH = 'match';

    public $errors;
    public $success;
    public DBConnection $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DBConnection();
    }

    abstract public function rules(): array;

    abstract public function labels(): array;

    public function loadData($data)
    {
        if ($data !== null) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function returnLoadData($data)
    {
        if (is_array($data)) {
            foreach ($data as $item) {
                foreach ($item as $key => $value) {
                    if (property_exists($this, $key)) {
                        $this->{$key} = $value;
                    }
                }
            }
        } else {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }

        return $data;
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrors($attribute, $ruleName);
                }

                if ($ruleName === self::RULE_EMAIL_UNIQUE && $this->uniqueEmail($value)) {
                    $this->addErrors($attribute, $ruleName);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, $ruleName);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorsWithParams($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
    }

    public function addErrors($attribute, $rule)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        return $this->errors[$attribute][] = $message;
    }

    public function addErrorsWithParams($attribute, $rule, $params)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{$key}", $value, $message);
        }

        return $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field must be valid email format",
            self::RULE_EMAIL_UNIQUE => "Email already exist",
            self::RULE_MATCH => "This field must be same as {match}"
        ];
    }

    public function existError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function firstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

    public function uniqueEmail($email)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT * FROM users WHERE email = '$email';";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();

        if ($result !== null)
            return true;

        return false;
    }
}