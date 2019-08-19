<?php

namespace Sun\IPay\Helpers;

class Helper
{
    /**
     * @var string
     */
    private $salt;

    public function __construct()
    {
        $this->salt = addslashes(config('ipay.signature'));
    }

    public function getXmlSignature(string $xml): string
    {
        return md5("{$this->salt}{$xml}");
    }
}
