<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto;

use DateTimeInterface;
use Sun\IPay\Enum\IPayCurrencyEnum;
use Sun\IPay\Enum\LanguageEnum;
use Symfony\Component\Serializer\Annotation\SerializedName;

class BaseRequestDto implements RequestDtoInterface
{
    public function __construct(
        #[SerializedName('RequestType')] private string $requestType,
        #[SerializedName('DateTime')] private DateTimeInterface $dateTime,
        #[SerializedName('PersonalAccount')] private string $personalAccount,
        #[SerializedName('Currency')] private int $currency,
        #[SerializedName('RequestId')] private int $requestId,
        #[SerializedName('ServiceNo')] private ?int $serviceNo = null,
        #[SerializedName('Language')] private ?string $language = null,
    ) {
        IPayCurrencyEnum::checkAllowedValue($currency);
        LanguageEnum::checkAllowedValue($language, true);
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
