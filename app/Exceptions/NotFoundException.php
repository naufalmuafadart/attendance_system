<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends CustomException
{
    protected $message;
    protected $code;

    public function __construct($message = "Not Found")
    {
        parent::__construct($message, 404);
    }
}
