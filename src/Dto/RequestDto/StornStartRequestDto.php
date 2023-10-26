<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\StornStart;
use Symfony\Component\Serializer\Annotation\SerializedName;

class StornStartRequestDto extends BaseRequestDto
{
    public function __construct(
        #[SerializedName('StornStart')] private readonly StornStart $stornStart,
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

    public function getStornStart(): StornStart
    {
        return $this->stornStart;
    }
}
