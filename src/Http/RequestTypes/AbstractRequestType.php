<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Contracts\IPayServiceContract;

abstract class AbstractRequestType
{
    protected IPayServiceContract $iPayService;

    public function __construct(IPayServiceContract $iPayService)
    {
        $this->iPayService = $iPayService;
    }

    public abstract function generateResponse(array $data): AbstractIPayXmlGenerator;
}
