<?php

namespace Sun\IPay\Models;

class TransactionResultModel extends AbstractRequestModel implements TransactionResult
{
    private ?int $transactionId = null;
    private ?string $serviceProviderTrxId = null;
    private ?string $errorText = null;

    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    public function setTransactionId(?int $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getServiceProviderTrxId(): ?string
    {
        return $this->serviceProviderTrxId;
    }

    public function setServiceProviderTrxId(?string $serviceProviderTrxId): self
    {
        $this->serviceProviderTrxId = $serviceProviderTrxId;
        return $this;
    }

    public function getErrorText(): ?string
    {
        return $this->errorText;
    }

    public function setErrorText(?string $errorText): self
    {
        $this->errorText = $errorText;
        return $this;
    }

    protected function fillFromData(array $data)
    {
        parent::fillFromData($data);

        $this->setTransactionId($data['TransactionResult']['TransactionId'] ?? null)
            ->setServiceProviderTrxId($data['TransactionResult']['ServiceProvider_TrxId'] ?? null)
            ->setErrorText($data['TransactionResult']['ErrorText'] ?? null);
    }
}
