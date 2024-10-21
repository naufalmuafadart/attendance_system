<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message;
    protected $code;

    public function __construct($message = "Something went wrong!", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
