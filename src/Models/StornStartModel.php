<?php

namespace Sun\IPay\Models;

class StornStartModel extends AbstractRequestModel implements StornStart
{
    private ?int $transactionId = null;
    private ?string $serviceProviderTrxId = null;
    private ?float $amount = null;

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

    protected function fillFromData(array $data)
    {
        parent::fillFromData($data);

        $this->setTransactionId($data['StornStart']['TransactionId'] ?? null)
            ->setServiceProviderTrxId($data['StornStart']['ServiceProvider_TrxId'] ?? null)
            ->setAmount($data['StornStart']['Amount'] ?? null);
    }
}
