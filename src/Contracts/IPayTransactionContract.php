<?php

namespace Sun\IPay\Contracts;

interface IPayTransactionContract
{
    public function getTransactionId(): string;
}
