<?php

namespace Sun\IPay;

class IPayConfig
{
    public function getSignature(): ?string
    {
        return config('ipay.signature');
    }

    public function getXmlSignature(string $xml): string
    {
        $salt = addslashes($this->getSignature());
        return md5(sprintf('%s%s', $salt, $xml));
    }
}
