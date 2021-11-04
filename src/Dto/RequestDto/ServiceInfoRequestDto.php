<?php

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Dto\RequestDto\Data\ServiceInfo;
use Symfony\Component\Serializer\Annotation\SerializedName;

class ServiceInfoRequestDto extends BaseRequestDto
{
    /**
     * @SerializedName("ServiceInfo")
     */
    private ServiceInfo $serviceInfo;

    public function __construct(
        ServiceInfo $serviceInfo,
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
        $this->serviceInfo = $serviceInfo;
    }

    public function getServiceInfo(): ServiceInfo
    {
        return $this->serviceInfo;
    }
}