<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class IncorrectAmountErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        // TODO: localize
        return 'Неверно указана сумма заказа.';
    }
}
