<?php

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Address
{
    /**
     * @SerializedName("City")
     */
    private ?string $city;

    /**
     * @SerializedName("Street")
     */
    private ?string $street;

    /**
     * @SerializedName("House")
     */
    private ?string $house;

    /**
     * @SerializedName("Building")
     */
    private ?string $building;

    /**
     * @SerializedName("Apartment")
     */
    private ?string $apartment;

    public function __construct(
        ?string $city = null,
        ?string $street = null,
        ?string $house = null,
        ?string $building = null,
        ?string $apartment
    ) {
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->building = $building;
        $this->apartment = $apartment;
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
