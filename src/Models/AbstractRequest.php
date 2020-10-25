<?php

namespace Sun\IPay\Models;

use DateTime;

interface AbstractRequest
{
    public function getDateTime(): ?DateTime;

    public function getServiceNo(): ?int;

    public function getPersonalAccount(): ?string;

    public function getCurrency(): int;

    public function getRequestId(): ?int;

    public function getLanguage(): ?string;
}
