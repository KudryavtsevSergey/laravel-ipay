<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ServiceInfo
{
    /**
     * @SerializedName("Agent")
     */
    private int $agent;

    public function __construct(int $agent)
    {
        $this->agent = $agent;
    }

    public function getAgent(): int
    {
        return $this->agent;
    }
}
