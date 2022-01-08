<?php

namespace Sun\IPay\Http\RequestTypes;

use Sun\IPay\Dto\RequestDto\StornResultRequestDto;
use Sun\IPay\Exceptions\Order\InvalidPaymentAmountException;
use Sun\IPay\Exceptions\Order\OrderNotAvailableForStornException;
use Sun\IPay\Exceptions\Order\OrderNotFoundException;
use Sun\IPay\Exceptions\Order\StornNotInProcessException;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\IncorrectAmountErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\OrderNotFoundErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\StornNotInProcessErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\UnavailableStornErrorXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\StornXmlGenerator;

class StornResultRequestType extends AbstractRequestType
{
    public function processData(array $data): AbstractIPayXmlGenerator
    {
        /** @var StornResultRequestDto $request */
        $request = $this->arrayObjectMapper->deserialize($data, StornResultRequestDto::class);

        try {
            $this->iPayService->registerStorn($request);
            return new StornXmlGenerator();
        } catch (InvalidPaymentAmountException $e) {
            return new IncorrectAmountErrorXmlGenerator();
        } catch (OrderNotAvailableForStornException $e) {
            return new UnavailableStornErrorXmlGenerator($request);
        } catch (OrderNotFoundException $e) {
            return new OrderNotFoundErrorXmlGenerator($request);
        } catch (StornNotInProcessException $e) {
            return new StornNotInProcessErrorXmlGenerator($request);
        }
    }
}
