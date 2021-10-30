<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class UnavailableStornErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    private BaseRequestDto $request;

    public function __construct(BaseRequestDto $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.unavailable_storn', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
