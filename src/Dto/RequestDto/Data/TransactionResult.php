<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionResult
{
    public function __construct(
        #[SerializedName('TransactionId')] private int $transactionId,
        #[SerializedName('ServiceProvider_TrxId')] private string $serviceProviderTrxId,
        #[SerializedName('ErrorText')] private ?string $errorText = null,
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

    public function getErrorText(): ?string
    {
        return $this->errorText;
    }
}
