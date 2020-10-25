<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Models\AbstractRequest;

class UnavailablePaymentErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    private AbstractRequest $request;

    public function __construct(AbstractRequest $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    protected function getErrorMessage(): string
    {
        // TODO: localize
        return sprintf('Заказ %s недоступен для оплаты.', $this->request->getPersonalAccount());
    }
}
