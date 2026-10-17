<?php
namespace App\Providers;

class Validator {

    private array $errors = [];
    private string $key;
    private string $value;
    private string $name;

    // Select the field to validate
    public function field(string $key, $value, $name = null){
        $this->key = $key;
        $this->value = trim((string) ($value ?? ''));
        $this->name = ucfirst($name ?? $key);
        return $this;
    }

    // Field cannot be empty
    public function required(){
        if($this->value === ''){
            $this->errors[$this->key] = "$this->name is required";
        }
        return $this;
    }

    // Minimum length
    public function min(int $length){
        if(mb_strlen($this->value) < $length){
            $this->errors[$this->key] = "$this->name must be at least $length characters";
        }
        return $this;
    }

    // Maximum length
    public function max(int $length){
        if(mb_strlen($this->value) > $length){
            $this->errors[$this->key] = "$this->name must be at most $length characters";
        }
        return $this;
    }

    // Whole number
    public function int(){
        if($this->value !== '' && filter_var($this->value, FILTER_VALIDATE_INT) === false){
            $this->errors[$this->key] = "$this->name must be a whole number";
        }
        return $this;
    }

    // Number greater than 0 (decimals allowed)
    public function numeric(){
        if($this->value !== '' && (!is_numeric($this->value) || $this->value <= 0)){
            $this->errors[$this->key] = "$this->name must be greater than 0";
        }
        return $this;
    }

    // Valid email format
    public function email(){
        if($this->value !== '' && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->errors[$this->key] = "$this->name format is invalid";
        }
        return $this;
    }

    // Valid date (YYYY-MM-DD)
    public function date(){
        if($this->value === '') return $this;
        $date = \DateTime::createFromFormat('Y-m-d', $this->value);
        if(!$date || $date->format('Y-m-d') !== $this->value){
            $this->errors[$this->key] = "$this->name must be a valid date";
        }
        return $this;
    }

    // True if no errors
    public function isSuccess(): bool {
        return empty($this->errors);
    }

    // Return all errors
    public function getErrors(): array {
        return $this->errors;
    }
}