<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class IncorrectCurrencyErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        return __('ipay::messages.wrong_currency');
    }
}
