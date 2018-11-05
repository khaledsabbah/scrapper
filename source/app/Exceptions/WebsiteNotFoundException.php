<?php

namespace App\Exceptions;

use Exception;

/**
 * Class WebsiteNotFoundException
 * @package App\Exceptions
 */
class WebsiteNotFoundException extends Exception
{
    /**
     * @var
     */
    protected $message;


    /**
     * WebsiteNotFoundException constructor.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
