<?php

namespace Sun\IPay\Exceptions;

use RuntimeException;

class RequestTypeClassNotFoundException extends RuntimeException
{
    public function __construct(string $className)
    {
        $message = sprintf('The request type class %s does not exist.'. $className);
        parent::__construct($message);
    }
}
