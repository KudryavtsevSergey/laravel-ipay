<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StornStart
{
    public function __construct(
        #[SerializedName('TransactionId')] private int $transactionId,
        #[SerializedName('ServiceProvider_TrxId')] private string $serviceProviderTrxId,
        #[SerializedName('Amount')] private float $amount,
    ) {
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function getServiceProviderTrxId(): string
    {
        return $this->serviceProviderTrxId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
