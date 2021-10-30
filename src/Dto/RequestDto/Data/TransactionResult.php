<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionResult
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
     * @SerializedName("ErrorText")
     */
    private ?string $errorText;

    public function __construct(int $transactionId, string $serviceProviderTrxId, ?string $errorText = null)
    {
        $this->transactionId = $transactionId;
        $this->serviceProviderTrxId = $serviceProviderTrxId;
        $this->errorText = $errorText;
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function getServiceProviderTrxId(): string
    {
        return $this->serviceProviderTrxId;
    }

    public function getErrorText(): ?string
    {
        return $this->errorText;
    }
}
