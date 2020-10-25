<?php

namespace Sun\IPay\Exceptions;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\InternalErrorXmlGenerator;
use Throwable;

class InternalIPayError extends AbstractResponsableException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Internal Error', 0, $previous);
    }

    protected function getXmlGenerator(): AbstractIPayXmlGenerator
    {
        return new InternalErrorXmlGenerator();
    }
}
