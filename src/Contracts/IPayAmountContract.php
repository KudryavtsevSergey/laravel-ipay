<?php

namespace Sun\IPay\Contracts;

interface IPayAmountContract
{
    public function getAmount(): float;

    public function getIPayCurrency(): int;
}
