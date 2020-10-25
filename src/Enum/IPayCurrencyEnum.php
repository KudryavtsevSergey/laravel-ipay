<?php

namespace Sun\IPay\Enum;

class IPayCurrencyEnum extends AbstractEnum
{
    const RUB = 643;
    const USD = 840;
    const EUR = 978;
    const BYN = 933;

    public static function getValues(): array
    {
        return [
            self::RUB,
            self::USD,
            self::EUR,
            self::BYN,
        ];
    }
}
