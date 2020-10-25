<?php

namespace Sun\IPay\Contracts;

interface IPayOrderCheckerContract
{
    public function isExist(): bool;

    public function isAvailablePay(): bool;

    public function isAvailableStorn(): bool;
}
