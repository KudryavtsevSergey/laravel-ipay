<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class OrderNotFoundErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    private BaseRequestDto $request;

    public function __construct(BaseRequestDto $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.order_not_found', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
