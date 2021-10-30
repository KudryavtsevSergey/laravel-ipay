<?php

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Enum\IPayCurrencyEnum;
use Sun\IPay\Enum\LanguageEnum;
use Symfony\Component\Serializer\Annotation\SerializedName;

class BaseRequestDto implements RequestDtoInterface
{
    /**
     * @SerializedName("RequestType")
     */
    private string $requestType;

    /**
     * @SerializedName("DateTime")
     */
    private DateTimeInterface $dateTime;

    /**
     * @SerializedName("PersonalAccount")
     */
    private string $personalAccount;

    /**
     * @SerializedName("Currency")
     */
    private int $currency;

    /**
     * @SerializedName("RequestId")
     */
    private int $requestId;

    /**
     * @SerializedName("ServiceNo")
     */
    private ?int $serviceNo;

    /**
     * @SerializedName("Language")
     */
    private ?string $language;

    public function __construct(
        string $requestType,
        DateTimeInterface $dateTime,
        string $personalAccount,
        int $currency,
        int $requestId,
        ?int $serviceNo = null,
        ?string $language = null
    ) {
        IPayCurrencyEnum::checkAllowedValue($currency);
        LanguageEnum::checkAllowedValue($language, true);
        $this->requestType = $requestType;
        $this->dateTime = $dateTime;
        $this->personalAccount = $personalAccount;
        $this->currency = $currency;
        $this->requestId = $requestId;
        $this->serviceNo = $serviceNo;
        $this->language = $language;
    }

    public function getRequestType(): string
    {
        return $this->requestType;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public function getPersonalAccount(): string
    {
        return $this->personalAccount;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function getRequestId(): int
    {
        return $this->requestId;
    }

    public function getServiceNo(): ?int
    {
        return $this->serviceNo;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }
}
