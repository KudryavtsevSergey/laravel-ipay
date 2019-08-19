<?php

namespace Sun\IPay\Http\Responses\Errors;

class IncorrectAmountErrorResponse extends ErrorResponse
{
    public function __construct()
    {
        //TODO: localize
        parent::__construct("Неверно указана сумма.");
    }
}
