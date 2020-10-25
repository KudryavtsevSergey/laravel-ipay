<?php

namespace Sun\IPay\Contracts;

interface IPayPayerContract
{
    public function getName(): string;

    public function getSurname(): string;
}
