<?php

namespace Sun\IPay\Enum;

use Sun\IPay\Exceptions\InvalidValueException;

trait MapperTrait
{
    public static function map($field, $default = null)
    {
        $fields = static::fieldsMap();
        return self::mapFromFields($field, $fields, $default);
    }

    public static function flipMap($field, $default = null)
    {
        $fields = static::fieldsMap();
        $fields = array_flip($fields);
        return self::mapFromFields($field, $fields, $default);
    }

    private static function mapFromFields($field, array $fields, $default = null)
    {
        if (is_null($default)) {
            self::check($field, $fields);
        }

        return $fields[$field] ?? $default;
    }

    private static function check($field, array $fields): void
    {
        $allowedValues = array_keys($fields);
        if (!in_array($field, $allowedValues)) {
            throw new InvalidValueException($field, $allowedValues);
        }
    }

    protected abstract static function fieldsMap(): array;
}
