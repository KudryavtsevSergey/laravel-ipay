<?php

namespace Sun\IPay\Http\Controllers;

use Exception;
use SimpleXMLElement;
use Sun\IPay\Http\Requests\IPayRequest;
use Sun\IPay\Services\IPayServiceContract;

class IPayController extends Controller
{
    public function index(IPayServiceContract $iPayService, IPayRequest $request)
    {
        $xml = $request->input('XML');

        $xml = new SimpleXMLElement($xml);

        $className = "Sun\\IPay\\Http\\RequestTypes\\{$xml->RequestType}RequestType";

        if (!class_exists($className)) {
            //TODO: localize
            throw new Exception("The class {$className} does not exist.");
        }

        $requestType = new $className($iPayService);
        $iPayResponse = $requestType->generateResponse($xml);

        return $iPayResponse->get();
    }
}
