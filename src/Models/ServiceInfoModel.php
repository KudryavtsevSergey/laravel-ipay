<?php

namespace Sun\IPay\Models;

class ServiceInfoModel extends AbstractRequestModel implements ServiceInfo
{
    private ?int $agent = null;

    public function getAgent(): ?int
    {
        return $this->agent;
    }

    public function setAgent(?int $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    protected function fillFromData(array $data)
    {
        parent::fillFromData($data);
        $this->setAgent($data['ServiceInfo']['Agent'] ?? null);
    }
}
