<?php

namespace Sun\IPay\Exceptions\Order;

use Throwable;

class InvalidPaymentAmountException extends AbstractOrderException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Invalid payment amount', $previous);
    }
}
