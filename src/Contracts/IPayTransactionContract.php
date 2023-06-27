<?php

declare(strict_types=1);

namespace Sun\IPay\Contracts;

interface IPayTransactionContract
{
    public function getTransactionId(): string;
}
