<?php

namespace Digia\WordPress\Api;

class Response
{
    protected $status;

    protected $message;

    protected $errors = [];

    public function setStatus($status)
    {
        $this->status = $status;

        return $this; 
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this; 
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;

        return $this; 
    }

    public function respond()
    {
        return json_encode($this->buildResponse());
    }

    protected function buildResponse()
    {
        $response = [];
        $response['status'] = strtolower($this->status);
        $response['message'] = $this->message;
        $response['data'] = $this->errors;

        return $response;
    }
}
