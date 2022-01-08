<?php

namespace Sun\IPay\Exceptions\Order;

use Exception;
use Throwable;

abstract class AbstractOrderException extends Exception
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
