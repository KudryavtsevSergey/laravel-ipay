<?php

namespace Sun\IPay\Exceptions;

class RequestTypeClassNotFoundException extends InternalError
{
    public function __construct(string $className)
    {
        $message = sprintf('The request type class %s does not exist.' . $className);
        parent::__construct($message);
    }
}
