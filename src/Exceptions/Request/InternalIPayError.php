<?php

namespace Sun\IPay\Exceptions\Request;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\InternalErrorXmlGenerator;
use Sun\IPay\Service\SignatureService;
use Throwable;

class InternalIPayError extends AbstractResponsableException
{
    public function __construct(Throwable $previous, SignatureService $signatureService)
    {
        parent::__construct('Internal Error', $signatureService, $previous);
    }

    protected function getXmlGenerator(): AbstractIPayXmlGenerator
    {
        return new InternalErrorXmlGenerator();
    }
}
