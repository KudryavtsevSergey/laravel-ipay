<?php

declare(strict_types=1);

namespace Sun\IPay\Dto\RequestDto\Data;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Name
{
    public function __construct(
        #[SerializedName('Surname')] private readonly ?string $surname = null,
        #[SerializedName('FirstName')] private readonly ?string $firstName = null,
        #[SerializedName('Patronymic')] private readonly ?string $patronymic = null,
    ) {
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
