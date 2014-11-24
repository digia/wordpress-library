<?php

namespace Digia\WordPress\Mail;

use Digia\Foundation\Mail\EmailValidator;

class ContactEmailValidator extends EmailValidator
{
    public function validateFullName($fullName)
    {
        if ( ! empty($fullName)) return true;

        $this->error['fullName'] = 'Full name is required. Please provide a valid full name.';

        return false;
    }

    public function validateMessage($message)
    {
        if ( ! empty($message)) return true;

        $this->errors['message'] = 'A message is required. Please provide a brief message.';

        return false; 
    }
}
