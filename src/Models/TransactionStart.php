<?php

namespace Sun\IPay\Models;

interface TransactionStart extends AbstractRequest
{
    public function getAmount(): ?float;

    public function getTransactionId(): ?int;

    public function getAgent(): ?int;

    public function getAuthorizationType(): ?string;

    public function getSurname(): ?string;

    public function getFirstName(): ?string;

    public function getPatronymic(): ?string;

    public function getCity(): ?string;

    public function getStreet(): ?string;

    public function getHouse(): ?string;

    public function getBuilding(): ?string;

    public function getApartment(): ?string;
}
