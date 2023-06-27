<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Address
{
    public function __construct(
        #[SerializedName('City')] private ?string $city = null,
        #[SerializedName('Street')] private ?string $street = null,
        #[SerializedName('House')] private ?string $house = null,
        #[SerializedName('Building')] private ?string $building = null,
        #[SerializedName('Apartment')] private ?string $apartment = null,
    ) {
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function getApartment(): ?string
    {
        return $this->apartment;
    }
}
