<?php

namespace Sun\IPay\Models;

use DateTime;
use Sun\IPay\Enum\IPayCurrencyEnum;

abstract class AbstractRequestModel extends AbstractModel implements AbstractRequest
{
    private ?DateTime $dateTime = null;
    private ?int $serviceNo = null;
    private ?string $personalAccount = null;
    private int $currency = IPayCurrencyEnum::BYN;
    private ?int $requestId = null;
    private ?string $language = null;

    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }

    public function setDateTime(?DateTime $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function getServiceNo(): ?int
    {
        return $this->serviceNo;
    }

    public function setServiceNo(?int $serviceNo): self
    {
        $this->serviceNo = $serviceNo;
        return $this;
    }

    public function getPersonalAccount(): ?string
    {
        return $this->personalAccount;
    }

    public function setPersonalAccount(?string $personalAccount): self
    {
        $this->personalAccount = $personalAccount;
        return $this;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function setCurrency(?int $currency): self
    {
        $this->currency = $currency ?? IPayCurrencyEnum::BYN;
        return $this;
    }

    public function getRequestId(): ?int
    {
        return $this->requestId;
    }

    public function setRequestId(?int $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    protected function fillFromData(array $data)
    {
        $dateTime = $data['DateTime'] ?? null;
        if ($dateTime) {
            $dateTime = DateTime::createFromFormat('YmdHis', $dateTime);
        }

        $this->setDateTime($dateTime)
            ->setServiceNo($data['ServiceNo'] ?? null)
            ->setPersonalAccount($data['PersonalAccount'] ?? null)
            ->setCurrency($data['Currency'] ?? null)
            ->setRequestId($data['RequestId'] ?? null)
            ->setLanguage($data['Language'] ?? null);
    }
}
