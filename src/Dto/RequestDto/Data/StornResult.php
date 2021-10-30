<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StornResult extends StornStart
{
    /**
     * @SerializedName("Storned")
     */
    private bool $storned;

    public function __construct(int $transactionId, string $serviceProviderTrxId, float $amount, bool $storned)
    {
        parent::__construct($transactionId, $serviceProviderTrxId, $amount);
        $this->storned = $storned;
    }

    public function isStorned(): bool
    {
        return $this->storned;
    }
}
