<?php

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\TransactionResult;
use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionResultRequestDto extends BaseRequestDto
{
    /**
     * @SerializedName("TransactionResult")
     */
    private TransactionResult $transactionResult;

    public function __construct(
        TransactionResult $transactionResult,
        string $requestType,
        DateTimeInterface $dateTime,
        string $personalAccount,
        int $currency,
        int $requestId,
        ?int $serviceNo = null,
        ?string $language = null
    ) {
        parent::__construct(
            $requestType,
            $dateTime,
            $personalAccount,
            $currency,
            $requestId,
            $serviceNo,
            $language
        );
        $this->transactionResult = $transactionResult;
    }

    public function getTransactionResult(): TransactionResult
    {
        return $this->transactionResult;
    }
}
