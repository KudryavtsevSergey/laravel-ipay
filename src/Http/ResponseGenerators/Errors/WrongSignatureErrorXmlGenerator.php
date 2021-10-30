<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class WrongSignatureErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        return __('ipay::messages.wrong_signature');
    }
}
