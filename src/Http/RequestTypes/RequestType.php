<?php

namespace Sun\IPay\Http\RequestTypes;

use SimpleXMLElement;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Services\IPayServiceContract;

abstract class RequestType
{
    protected IPayServiceContract $iPayService;

    public function __construct(IPayServiceContract $iPayService)
    {
        $this->iPayService = $iPayService;
    }

    public abstract function generateResponse(SimpleXMLElement $xml): IPayResponse;
}
