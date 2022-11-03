<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Contracts\IPayServiceContract;
use Sun\IPay\Enum\RequestTypeEnum;
use Sun\IPay\Mapper\ArrayObjectMapper;

class RequestTypeFactory
{
    public function __construct(
        private IPayServiceContract $iPayService,
        private ArrayObjectMapper $arrayObjectMapper,
    ) {
    }

    public function createRequestType(string $requestType): AbstractRequestType
    {
        switch ($requestType) {
            case RequestTypeEnum::SERVICE_INFO:
                return new ServiceInfoRequestType($this->iPayService, $this->arrayObjectMapper);
            case RequestTypeEnum::TRANSACTION_START:
                return new TransactionStartRequestType($this->iPayService, $this->arrayObjectMapper);
            case RequestTypeEnum::TRANSACTION_RESULT:
                return new TransactionResultRequestType($this->iPayService, $this->arrayObjectMapper);
            case RequestTypeEnum::STORN_START:
                return new StornStartRequestType($this->iPayService, $this->arrayObjectMapper);
            case RequestTypeEnum::STORN_RESULT:
                return new StornResultRequestType($this->iPayService, $this->arrayObjectMapper);
            default:
                throw RequestTypeEnum::invalidValue($requestType);
        }
    }
}
