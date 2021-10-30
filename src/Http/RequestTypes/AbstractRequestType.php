<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Contracts\IPayServiceContract;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Mapper\ArrayObjectMapper;

abstract class AbstractRequestType
{
    protected IPayServiceContract $iPayService;
    protected ArrayObjectMapper $arrayObjectMapper;

    public function __construct(IPayServiceContract $iPayService, ArrayObjectMapper $arrayObjectMapper)
    {
        $this->iPayService = $iPayService;
        $this->arrayObjectMapper = $arrayObjectMapper;
    }

    public abstract function processData(array $data): AbstractIPayXmlGenerator;
}
