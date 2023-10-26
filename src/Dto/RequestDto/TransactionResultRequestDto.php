<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\TransactionResult;
use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionResultRequestDto extends BaseRequestDto
{
    public function __construct(
        #[SerializedName('TransactionResult')] private readonly TransactionResult $transactionResult,
        string $requestType,
        DateTimeInterface $dateTime,
        string $personalAccount,
        int $currency,
        int $requestId,
        ?int $serviceNo = null,
        ?string $language = null,
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
    }

    public function getTransactionResult(): TransactionResult
    {
        return $this->transactionResult;
    }
}
