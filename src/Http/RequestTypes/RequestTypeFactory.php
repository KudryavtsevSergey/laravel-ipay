<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Contracts\IPayServiceContract;
use Sun\IPay\Exceptions\RequestTypeClassNotFoundException;
use Sun\IPay\Mapper\ArrayObjectMapper;

class RequestTypeFactory
{
    private IPayServiceContract $iPayService;
    private ArrayObjectMapper $arrayObjectMapper;

    public function __construct(
        IPayServiceContract $iPayService,
        ArrayObjectMapper $arrayObjectMapper
    ) {
        $this->iPayService = $iPayService;
        $this->arrayObjectMapper = $arrayObjectMapper;
    }

    public function createRequestType(string $requestType): AbstractRequestType
    {
        $className = sprintf('Sun\\IPay\\Http\\RequestTypes\\%sRequestType', $requestType);

        if (!class_exists($className)) {
            throw new RequestTypeClassNotFoundException($className);
        }

        return new $className($this->iPayService, $this->arrayObjectMapper);

    }
}
