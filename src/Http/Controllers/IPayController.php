<?php

namespace Sun\IPay\Http\Controllers;

use Sun\IPay\Exceptions\RequestTypeClassNotFoundException;
use Sun\IPay\Http\Requests\IPayRequest;
use Sun\IPay\Http\RequestTypes\AbstractRequestType;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\IPayConfig;
use Sun\IPay\Contracts\IPayServiceContract;

class IPayController extends AbstractController
{
    private IPayServiceContract $iPayService;
    private IPayConfig $config;

    public function __construct(IPayServiceContract $iPayService, IPayConfig $config)
    {
        $this->iPayService = $iPayService;
        $this->config = $config;
    }

    public function index(IPayRequest $request): IPayResponse
    {
        $data = $this->getDataFromRequest($request);
        $requestType = $data['RequestType'] ?? null;

        $className = sprintf('Sun\\IPay\\Http\\RequestTypes\\%sRequestType', $requestType);

        if (!class_exists($className)) {
            throw new RequestTypeClassNotFoundException($className);
        }
        unset($data['RequestType']);

        /** @var AbstractRequestType $requestType */
        $requestType = new $className($this->iPayService);
        $generator = $requestType->generateResponse($data);

        return new IPayResponse($generator, $this->config);
    }

    private function getDataFromRequest(IPayRequest $request): array
    {
        $xml = $request->input('XML');
        return json_decode(json_encode((array)simplexml_load_string($xml)), true);
    }
}
