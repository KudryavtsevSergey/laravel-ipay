<?php

namespace Sun\IPay\Http\Responses\Errors;

class IncorrectAmountErrorResponse extends ErrorResponse
{
    protected function getErrorMessage(): string
    {
        // TODO: localize
        return 'Неверно указана сумма.';
    }
}
