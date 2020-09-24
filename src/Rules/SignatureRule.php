<?php

namespace Sun\IPay\Rules;

use Illuminate\Contracts\Validation\Rule;
use Sun\IPay\IPayConfig;

class SignatureRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $xml
     * @return bool
     */
    public function passes($attribute, $xml)
    {
        $actualSignature = $this->getHttpSignature();
        $expectedSignature = IPayConfig::getXmlSignature($xml);

        return strcasecmp($expectedSignature, $actualSignature) == 0;
    }

    private function getHttpSignature(): string
    {
        if (preg_match('/SALT\+MD5:\s(.*)/', $_SERVER['HTTP_SERVICEPROVIDER_SIGNATURE'] ?? '', $matches)) {
            return $matches[1];
        }

        return '';
    }

    public function message()
    {
        //TODO: return error xml response
        //TODO: localize
        return 'The validation error message.';
    }
}
