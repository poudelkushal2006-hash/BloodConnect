<?php
// app/core/Validator.php

class Validator {
    private $errors = [];

    public function addError($field, $message) {
        $this->errors[$field] = $message;
    }

    public function validatePhone($phone, $field = 'phone') {
        // Simple Nepali mobile validation (98XXXXXXXX or 97XXXXXXXX)
        if (!preg_match('/^(98|97)\d{8}$/', $phone)) {
            $this->errors[$field] = "Invalid Nepali mobile number. Must start with 98 or 97 and be 10 digits.";
        }
    }

    public function validateRequired($value, $field, $message = "This field is required.") {
        if (empty(trim($value))) {
            $this->errors[$field] = $message;
        }
    }

    public function validateEnum($value, $allowedValues, $field, $message = "Invalid selection.") {
        if (!in_array($value, $allowedValues)) {
            $this->errors[$field] = $message;
        }
    }

    public function validateAge($age, $field = 'age') {
        if (!is_numeric($age) || $age < 18 || $age > 65) {
            $this->errors[$field] = "Age must be between 18 and 65 to donate blood.";
        }
    }

    public function validateConsent($value, $field = 'consent_given') {
        if (!$value) {
            $this->errors[$field] = "You must provide consent to display your contact number.";
        }
    }

    public function hasErrors() {
        return !empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}
