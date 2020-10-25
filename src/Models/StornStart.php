<?php

namespace Sun\IPay\Models;

interface StornStart extends AbstractRequest
{
    public function getTransactionId(): ?int;

    public function getServiceProviderTrxId(): ?string;

    public function getAmount(): ?float;
}
