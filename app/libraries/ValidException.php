<?php

class ValidException extends Exception
{
    private array $errors = array();

    public function __construct(array $errors = array(), string $message = null)
    {
        parent::__construct($message);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}