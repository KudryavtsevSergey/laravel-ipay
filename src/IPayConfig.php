<?php

declare(strict_types=1);

namespace Sun\IPay;

use Illuminate\Contracts\Config\Repository;

class IPayConfig
{
    public function __construct(
        private readonly Repository $config,
    ) {
    }

    public function getSignature(): string
    {
        return $this->config->get('ipay.signature');
    }
}
