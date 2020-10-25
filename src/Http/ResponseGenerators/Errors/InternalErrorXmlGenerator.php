<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

class InternalErrorXmlGenerator extends AbstractErrorXmlGenerator
{
    protected function getErrorMessage(): string
    {
        // TODO: localize
        return 'Внутренняя ошибка.';
    }
}
