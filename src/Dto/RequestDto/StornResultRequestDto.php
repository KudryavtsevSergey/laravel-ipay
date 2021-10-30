<?php

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\StornResult;
use Symfony\Component\Serializer\Annotation\SerializedName;

class StornResultRequestDto extends BaseRequestDto
{
    /**
     * @SerializedName("StornResult")
     */
    private StornResult $stornResult;

    public function __construct(
        StornResult $stornResult,
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
        $this->stornResult = $stornResult;
    }

    public function getStornResult(): StornResult
    {
        return $this->stornResult;
    }
}
