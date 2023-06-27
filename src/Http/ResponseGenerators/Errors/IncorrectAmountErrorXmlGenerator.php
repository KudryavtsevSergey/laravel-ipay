<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class IncorrectAmountErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        return __('ipay::messages.incorrect_amount');
    }
}
