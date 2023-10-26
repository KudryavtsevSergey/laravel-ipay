<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionResult
{
    public function __construct(
        #[SerializedName('TransactionId')] private readonly int $transactionId,
        #[SerializedName('ServiceProvider_TrxId')] private readonly string $serviceProviderTrxId,
        #[SerializedName('ErrorText')] private readonly ?string $errorText = null,
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
