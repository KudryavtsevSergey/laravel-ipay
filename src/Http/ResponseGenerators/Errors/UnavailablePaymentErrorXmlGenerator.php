<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class UnavailablePaymentErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    public function __construct(
        private BaseRequestDto $request,
    ) {
        parent::__construct();
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.unavailable_payment', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
