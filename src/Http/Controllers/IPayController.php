<?php

namespace Sun\IPay\Http\Controllers;

use SimpleXMLElement;
use Sun\IPay\Exceptions\RequestTypeClassNotFoundException;
use Sun\IPay\Http\Requests\IPayRequest;
use Sun\IPay\Http\RequestTypes\RequestType;
use Sun\IPay\Services\IPayServiceContract;

class IPayController extends Controller
{
    /**
     * @param IPayServiceContract $iPayService
     * @param IPayRequest $request
     * @return mixed
     * @throws RequestTypeClassNotFoundException
     */
    public function index(IPayServiceContract $iPayService, IPayRequest $request)
    {
        $xml = $request->input('XML');

        $xml = new SimpleXMLElement($xml);

        $className = "Sun\\IPay\\Http\\RequestTypes\\{$xml->RequestType}RequestType";

        if (!class_exists($className)) {
            throw new RequestTypeClassNotFoundException($className);
        }

        /** @var RequestType $requestType */
        $requestType = new $className($iPayService);
        $iPayResponse = $requestType->generateResponse($xml);

        return $iPayResponse->get();
    }
}
