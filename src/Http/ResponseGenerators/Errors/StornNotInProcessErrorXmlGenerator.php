<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class StornNotInProcessErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    private BaseRequestDto $request;

    public function __construct(BaseRequestDto $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.storn_not_in_process', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
