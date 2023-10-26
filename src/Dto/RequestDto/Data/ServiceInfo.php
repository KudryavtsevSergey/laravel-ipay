<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ServiceInfo
{
    public function __construct(
        #[SerializedName('Agent')] private readonly int $agent,
    ) {
    }

    public function getAgent(): int
    {
        return $this->agent;
    }
}
