<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StornStart
{
    public function __construct(
        #[SerializedName('TransactionId')] private readonly int $transactionId,
        #[SerializedName('ServiceProvider_TrxId')] private readonly string $serviceProviderTrxId,
        #[SerializedName('Amount')] private readonly float $amount,
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
