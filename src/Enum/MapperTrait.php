<?php

namespace Sun\IPay\Enum;

use Sun\IPay\Exceptions\InvalidValueException;

trait MapperTrait
{
    public static function map(mixed $field, $default = null): mixed
    {
        $fields = static::fieldsMap();
        return self::mapFromFields($field, $fields, $default);
    }

    public static function flipMap(mixed $field, $default = null): mixed
    {
        $fields = static::fieldsMap();
        $fields = array_flip($fields);
        return self::mapFromFields($field, $fields, $default);
    }

    private static function mapFromFields(mixed $field, array $fields, $default = null): mixed
    {
        if (is_null($default)) {
            self::check($field, $fields);
        }

        return $fields[$field] ?? $default;
    }

    private static function check(mixed $field, array $fields): void
    {
        $allowedValues = array_keys($fields);
        if (!in_array($field, $allowedValues, true)) {
            throw new InvalidValueException($field, $allowedValues);
        }
    }

    protected abstract static function fieldsMap(): array;
}
