<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\TransactionStart;
use Symfony\Component\Serializer\Annotation\SerializedName;

class TransactionStartRequestDto extends BaseRequestDto
{
    public function __construct(
        #[SerializedName('TransactionStart')] private readonly TransactionStart $transactionStart,
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

    public function getTransactionStart(): TransactionStart
    {
        return $this->transactionStart;
    }
}
