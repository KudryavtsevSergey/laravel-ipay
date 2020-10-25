<?php

namespace Sun\IPay\Rules;

use Illuminate\Contracts\Validation\Rule;
use Sun\IPay\IPayConfig;

class SignatureRule implements Rule
{
    private IPayConfig $config;

    public function __construct(IPayConfig $config)
    {
        $this->config = $config;
    }

    public function passes($attribute, $xml)
    {
        $actualSignature = $this->getHttpSignature();
        $expectedSignature = $this->config->getXmlSignature($xml);

        return strcasecmp($expectedSignature, $actualSignature) == 0;
    }

    private function getHttpSignature(): ?string
    {
        if (preg_match('/SALT\+MD5:\s(.*)/', $_SERVER['HTTP_SERVICEPROVIDER_SIGNATURE'] ?? '', $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function message()
    {
        // TODO: localize
        return 'Сигнатура не совпадает.';
    }
}
