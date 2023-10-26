<?php

declare(strict_types=1);

namespace Sun\IPay\Service;

use Sun\IPay\IPayConfig;

class SignatureService
{
    public function __construct(
        private readonly IPayConfig $config,
    ) {
    }

    public function generate(string $xml): string
    {
        $salt = addslashes($this->config->getSignature());
        return md5(sprintf('%s%s', $salt, $xml));
    }

    public function verify(string $xml, string $signature): bool
    {
        $expected = $this->generate($xml);

        return strcasecmp($expected, $signature) === 0;
    }
}
