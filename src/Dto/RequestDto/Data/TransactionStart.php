<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionStart extends ServiceInfo
{
    /**
     * @SerializedName("Amount")
     */
    private float $amount;

    /**
     * @SerializedName("TransactionId")
     */
    private int $transactionId;

    /**
     * @SerializedName("AuthorizationType")
     */
    private string $authorizationType;

    /**
     * @SerializedName("Name")
     */
    private ?Name $name;

    /**
     * @SerializedName("Address")
     */
    private ?Address $address;

    public function __construct(
        float $amount,
        int $transactionId,
        int $agent,
        string $authorizationType,
        ?Name $name,
        ?Address $address
    ) {
        parent::__construct($agent);
        $this->amount = $amount;
        $this->transactionId = $transactionId;
        $this->authorizationType = $authorizationType;
        $this->name = $name;
        $this->address = $address;
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
