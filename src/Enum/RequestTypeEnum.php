<?php

declare(strict_types=1);

namespace Sun\IPay\Enum;

class RequestTypeEnum extends AbstractEnum
{
    public const SERVICE_INFO = 'ServiceInfo';
    public const STORN_RESULT = 'StornResult';
    public const STORN_START = 'StornStart';
    public const TRANSACTION_RESULT = 'TransactionResult';
    public const TRANSACTION_START = 'TransactionStart';

    public static function getValues(): array
    {
        return [
            self::SERVICE_INFO,
            self::STORN_RESULT,
            self::STORN_START,
            self::TRANSACTION_RESULT,
            self::TRANSACTION_START,
        ];
    }
}
