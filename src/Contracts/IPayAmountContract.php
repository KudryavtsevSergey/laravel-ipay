<?php

declare(strict_types=1);

namespace Sun\IPay\Contracts;

interface IPayAmountContract
{
    public function getAmount(): float;

    public function getIPayCurrency(): int;
}
