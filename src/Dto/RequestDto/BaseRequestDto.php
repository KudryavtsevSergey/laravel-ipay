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
        #[SerializedName('RequestType')] private readonly string $requestType,
        #[SerializedName('DateTime')] private readonly DateTimeInterface $dateTime,
        #[SerializedName('PersonalAccount')] private readonly string $personalAccount,
        #[SerializedName('Currency')] private readonly int $currency,
        #[SerializedName('RequestId')] private readonly int $requestId,
        #[SerializedName('ServiceNo')] private readonly ?int $serviceNo = null,
        #[SerializedName('Language')] private readonly ?string $language = null,
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
