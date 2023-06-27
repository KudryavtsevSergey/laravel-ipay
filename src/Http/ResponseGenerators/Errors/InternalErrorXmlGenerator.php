<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class InternalErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        return __('ipay::messages.internal_error');
    }
}
