<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StornStart
{
    /**
     * @SerializedName("TransactionId")
     */
    private int $transactionId;

    /**
     * @SerializedName("ServiceProvider_TrxId")
     */
    private string $serviceProviderTrxId;

    /**
     * @SerializedName("Amount")
     */
    private float $amount;

    public function __construct(int $transactionId, string $serviceProviderTrxId, float $amount)
    {
        $this->transactionId = $transactionId;
        $this->serviceProviderTrxId = $serviceProviderTrxId;
        $this->amount = $amount;
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
