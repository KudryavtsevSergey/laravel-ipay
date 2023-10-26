<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Address
{
    public function __construct(
        #[SerializedName('City')] private readonly ?string $city = null,
        #[SerializedName('Street')] private readonly ?string $street = null,
        #[SerializedName('House')] private readonly ?string $house = null,
        #[SerializedName('Building')] private readonly ?string $building = null,
        #[SerializedName('Apartment')] private readonly ?string $apartment = null,
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
