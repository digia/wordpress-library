<?php

namespace Digia\Foundation\Mail;

use Digia\Foundation\Validator;

class EmailValidator extends Validator 
{
    public function validateEmail($email)
    {
        $validated = filter_var($email, FILTER_VALIDATE_EMAIL); 

        if ($validated) return true;

        $this->errors['email'] = 'Email is required. Please provide a valid email address.';

        return false;
    }

}
