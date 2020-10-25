<?php

namespace Sun\IPay\Enum;

use Sun\IPay\Exceptions\InvalidValueException;

abstract class AbstractEnum
{
    /**
     * @param $value
     * @throws InvalidValueException
     */
    public static function checkAllowedValue($value)
    {
        if (!static::isContainValue($value)) {
            throw new InvalidValueException($value, static::getValues());
        }
    }

    public static function isContainValue($value): bool
    {
        return in_array($value, static::getValues());
    }

    abstract public static function getValues(): array;
}
