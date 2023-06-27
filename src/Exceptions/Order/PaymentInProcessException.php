<?php

declare(strict_types=1);

namespace Sun\IPay\Exceptions\Order;

use Throwable;

class PaymentInProcessException extends AbstractOrderException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Payment in process', $previous);
    }
}
