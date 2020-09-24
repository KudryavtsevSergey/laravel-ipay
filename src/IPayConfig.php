<?php

namespace Sun\IPay;

class IPayConfig
{
    public static function getSignature(): string
    {
        return config('ipay.signature');
    }

    public static function getXmlSignature(string $xml): string
    {
        $salt = addslashes(self::getSignature());
        return md5(sprintf('%s%s', $salt, $xml));
    }
}
