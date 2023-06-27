<?php

declare(strict_types=1);

namespace Sun\IPay\Enum;

use Sun\IPay\Exceptions\InvalidValueException;

trait MapperTrait
{
    public static function map(string|int|null $field, mixed $default = null): mixed
    {
        $fields = static::fieldsMap();
        return self::mapFromFields($field, $fields, $default);
    }

    public static function flipMap(string|int|null $field, mixed $default = null): mixed
    {
        $fields = static::fieldsMap();
        $fields = array_flip($fields);
        return self::mapFromFields($field, $fields, $default);
    }

    private static function mapFromFields(string|int|null $field, array $fields, mixed $default = null): mixed
    {
        if ($default === null) {
            self::check($field, $fields);
        }

        return $fields[$field] ?? $default;
    }

    private static function check(string|int|null $field, array $fields): void
    {
        $allowedValues = array_keys($fields);
        if (!in_array($field, $allowedValues, true)) {
            throw new InvalidValueException($field, $allowedValues);
        }
    }

    protected abstract static function fieldsMap(): array;
}
