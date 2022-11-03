<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Contracts\IPayServiceContract;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Mapper\ArrayObjectMapper;

abstract class AbstractRequestType
{
    public function __construct(
        protected IPayServiceContract $iPayService,
        protected ArrayObjectMapper $arrayObjectMapper,
    ) {
    }

    public abstract function processData(array $data): AbstractIPayXmlGenerator;
}
