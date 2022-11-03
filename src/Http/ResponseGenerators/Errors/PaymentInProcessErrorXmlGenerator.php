<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class PaymentInProcessErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    public function __construct(
        private BaseRequestDto $request,
    ) {
        parent::__construct();
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.payment_in_process', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
