<?php

declare(strict_types=1);

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
        return match ($requestType) {
            RequestTypeEnum::SERVICE_INFO => new ServiceInfoRequestType($this->iPayService, $this->arrayObjectMapper),
            RequestTypeEnum::TRANSACTION_START => new TransactionStartRequestType($this->iPayService,
                $this->arrayObjectMapper),
            RequestTypeEnum::TRANSACTION_RESULT => new TransactionResultRequestType($this->iPayService,
                $this->arrayObjectMapper),
            RequestTypeEnum::STORN_START => new StornStartRequestType($this->iPayService, $this->arrayObjectMapper),
            RequestTypeEnum::STORN_RESULT => new StornResultRequestType($this->iPayService, $this->arrayObjectMapper),
            default => throw RequestTypeEnum::invalidValue($requestType),
        };
    }
}
