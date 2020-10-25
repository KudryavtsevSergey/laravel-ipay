<?php

namespace Sun\IPay\Models;

class StornResultModel extends AbstractRequestModel implements StornResult
{
    private ?int $transactionId = null;
    private ?string $serviceProviderTrxId = null;
    private ?float $amount = null;
    private ?bool $storned = null;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getFormattedAmount(): ?float
    {
        return $this->amount ? floatval(str_replace(',', '.', $this->amount)) : null;
    }

    public function getStorned(): ?bool
    {
        return $this->storned;
    }

    public function setStorned(?bool $storned): self
    {
        $this->storned = $storned;
        return $this;
    }

    protected function fillFromData(array $data)
    {
        parent::fillFromData($data);

        $this->setTransactionId($data['StornResult']['TransactionId'] ?? null)
            ->setServiceProviderTrxId($data['StornResult']['ServiceProvider_TrxId'] ?? null)
            ->setAmount($data['StornResult']['Amount'] ?? null)
            ->setStorned($data['StornResult']['Storned'] ?? null);
    }
}
