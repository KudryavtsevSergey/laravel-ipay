<?php

namespace Sun\IPay\Models;

interface StornResult extends AbstractRequest
{
    public function getTransactionId(): ?int;

    public function getServiceProviderTrxId(): ?string;

    public function getAmount(): ?float;

    public function getStorned(): ?bool;
}
