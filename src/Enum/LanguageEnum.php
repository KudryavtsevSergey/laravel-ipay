<?php

declare(strict_types=1);

namespace Sun\IPay\Enum;

class LanguageEnum extends AbstractEnum
{
    use MapperTrait;

    public const RUSSIAN = 'RU';
    public const ENGLISH = 'EN';

    public static function getValues(): array
    {
        return [
            self::RUSSIAN,
            self::ENGLISH,
        ];
    }

    protected static function fieldsMap(): array
    {
        return [
            self::RUSSIAN => 'ru',
            self::ENGLISH => 'en',
        ];
    }
}
