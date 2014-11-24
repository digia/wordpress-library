<?php

namespace Digia\Foundation;

abstract class Validator 
{
    protected $errors = [];
    protected $data = [];

    public function validate(array $data = [])
    {
        if (empty($data)) $data = $this->data;

        foreach ($data as $field => $input) {
            $function = 'validate' . ucfirst($field);
            if ( ! method_exists($this, $function)) continue;
            $this->$function($input);
        } 

        if ( ! empty($this->errors)) return false;

        return true;
    }

    public function getErrors()
    {
        return $this->errors; 
    }
}
