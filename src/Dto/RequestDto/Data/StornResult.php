<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StornResult extends StornStart
{
    public function __construct(
        int $transactionId,
        string $serviceProviderTrxId,
        float $amount,
        #[SerializedName('Storned')] private bool $storned,
    ) {
        parent::__construct($transactionId, $serviceProviderTrxId, $amount);
    }

    public function isStorned(): bool
    {
        return $this->storned;
    }
}
