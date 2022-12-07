<?php

namespace Sun\IPay\Contracts;

interface IPayOrderInfoContract
{
    public function getIPayOrderId(): string;

    public function getIPayPayer(): IPayPayerContract;

    public function calculateIPayAmount(): IPayAmountContract;
}
