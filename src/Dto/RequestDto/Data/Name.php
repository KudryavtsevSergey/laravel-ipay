<?php

namespace Sun\IPay\Dto\RequestDto\Data;

class Name
{
    /**
     * @SerializedName("Surname")
     */
    private ?string $surname;

    /**
     * @SerializedName("FirstName")
     */
    private ?string $firstName;

    /**
     * @SerializedName("Patronymic")
     */
    private ?string $patronymic;

    public function __construct(?string $surname = null, ?string $firstName = null, ?string $patronymic = null)
    {
        $this->surname = $surname;
        $this->firstName = $firstName;
        $this->patronymic = $patronymic;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }
}
