<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Dto\RequestDto\BaseRequestDto;

class OrderNotFoundErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    public function __construct(
        private readonly BaseRequestDto $request,
    ) {
        parent::__construct();
    }

    protected function getErrorMessage(): string
    {
        return __('ipay::messages.order_not_found', ['order_id' => $this->request->getPersonalAccount()]);
    }
}
