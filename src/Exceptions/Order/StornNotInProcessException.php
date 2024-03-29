<?php

declare(strict_types=1);

namespace Sun\IPay\Exceptions\Order;

use Throwable;

class StornNotInProcessException extends AbstractOrderException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Storn not in process', $previous);
    }
}
