<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionStart extends ServiceInfo
{
    public function __construct(
        #[SerializedName('Amount')] private float $amount,
        #[SerializedName('TransactionId')] private int $transactionId,
        int $agent,
        #[SerializedName('AuthorizationType')] private string $authorizationType,
        #[SerializedName('Name')] private ?Name $name,
        #[SerializedName('Address')] private ?Address $address,
    ) {
        parent::__construct($agent);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function getAuthorizationType(): string
    {
        return $this->authorizationType;
    }

    public function getName(): ?Name
    {
        return $this->name;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}
