<?php

namespace Sun\IPay\Models;

class TransactionStartModel extends AbstractRequestModel implements TransactionStart
{
    private ?float $amount = null;
    private ?int $transactionId = null;
    private ?int $agent = null;
    private ?string $authorizationType = null;
    private ?string $surname = null;
    private ?string $firstName = null;
    private ?string $patronymic = null;
    private ?string $city = null;
    private ?string $street = null;
    private ?string $house = null;
    private ?string $building = null;
    private ?string $apartment = null;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getFormattedAmount(): ?float
    {
        return $this->amount ? floatval(str_replace(',', '.', $this->amount)) : null;
    }

    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    public function setTransactionId(?int $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getAgent(): ?int
    {
        return $this->agent;
    }

    public function setAgent(?int $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    public function getAuthorizationType(): ?string
    {
        return $this->authorizationType;
    }

    public function setAuthorizationType(?string $authorizationType): self
    {
        $this->authorizationType = $authorizationType;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house): self
    {
        $this->house = $house;
        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): self
    {
        $this->building = $building;
        return $this;
    }

    public function getApartment(): ?string
    {
        return $this->apartment;
    }

    public function setApartment(?string $apartment): self
    {
        $this->apartment = $apartment;
        return $this;
    }

    protected function fillFromData(array $data)
    {
        parent::fillFromData($data);

        $this->setAmount($data['TransactionStart']['Amount'] ?? null)
            ->setTransactionId($data['TransactionStart']['TransactionId'] ?? null)
            ->setAgent($data['TransactionStart']['Agent'] ?? null)
            ->setAuthorizationType($data['TransactionStart']['AuthorizationType'] ?? null)
            ->setSurname($data['TransactionStart']['Name']['Surname'] ?? null)
            ->setFirstName($data['TransactionStart']['Name']['FirstName'] ?? null)
            ->setPatronymic($data['TransactionStart']['Name']['Patronymic'] ?? null)
            ->setCity($data['TransactionStart']['Address']['City'] ?? null)
            ->setStreet($data['TransactionStart']['Address']['Street'] ?? null)
            ->setHouse($data['TransactionStart']['Address']['House'] ?? null)
            ->setBuilding($data['TransactionStart']['Address']['Building'] ?? null)
            ->setApartment($data['TransactionStart']['Address']['Apartment'] ?? null);
    }
}
