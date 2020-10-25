<?php

namespace Sun\IPay\Models;

interface TransactionResult extends AbstractRequest
{
    public function getTransactionId(): ?int;

    public function getServiceProviderTrxId(): ?string;

    public function getErrorText(): ?string;
}
