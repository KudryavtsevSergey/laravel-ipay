<?php

namespace Sun\IPay\Enum;

use Sun\IPay\Exceptions\InvalidValueException;

abstract class AbstractEnum
{
    public static function checkAllowedValue($value, bool $isAllowNull = false)
    {
        $isAllow = $isAllowNull && is_null($value);
        if (!$isAllow && !static::isContainValue($value)) {
            throw new InvalidValueException($value, static::getValues());
        }
    }

    public static function isContainValue($value): bool
    {
        return in_array($value, static::getValues());
    }

    abstract public static function getValues(): array;
}
