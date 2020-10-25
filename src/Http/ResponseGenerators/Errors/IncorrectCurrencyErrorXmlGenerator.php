<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class IncorrectCurrencyErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        // TODO: localize
        return 'Неверно указана валюта.';
    }
}
