<?php

namespace Sun\IPay;

class IPayConfig
{
    public function getSignature(): ?string
    {
        return config('ipay.signature');
    }
}
