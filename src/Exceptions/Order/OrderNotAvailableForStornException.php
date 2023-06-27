<?php

declare(strict_types=1);

namespace Sun\IPay\Exceptions\Order;

use Throwable;

class OrderNotAvailableForStornException extends AbstractOrderException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Order not available for storn', $previous);
    }
}
