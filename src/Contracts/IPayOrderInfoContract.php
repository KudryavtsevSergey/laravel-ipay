<?php

namespace Sun\IPay\Contracts;

interface IPayOrderInfoContract
{
    public function getOrderId(): string;

    public function getPayer(): IPayPayerContract;

    public function calculateAmount(): IPayAmountContract;
}
