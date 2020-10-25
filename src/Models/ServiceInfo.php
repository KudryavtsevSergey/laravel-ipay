<?php

namespace Sun\IPay\Models;

interface ServiceInfo extends AbstractRequest
{
    public function getAgent(): ?int;
}
