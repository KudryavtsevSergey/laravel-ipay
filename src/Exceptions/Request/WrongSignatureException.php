<?php

namespace Sun\IPay\Exceptions\Request;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\WrongSignatureErrorXmlGenerator;
use Sun\IPay\Service\SignatureService;

class WrongSignatureException extends AbstractResponsableException
{
    public function __construct(?string $signature, SignatureService $signatureService)
    {
        parent::__construct(sprintf('Wrong signature %s', $signature), $signatureService);
    }

    protected function getXmlGenerator(): AbstractIPayXmlGenerator
    {
        return new WrongSignatureErrorXmlGenerator();
    }
}
