<?php

declare(strict_types=1);

namespace Sun\IPay\Exceptions\Request;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\ResponseGenerators\Errors\WrongSignatureErrorXmlGenerator;
use Sun\IPay\Service\SignatureService;

class WrongSignatureException extends AbstractResponsableException
{
    public function __construct(SignatureService $signatureService, ?string $signature = null)
    {
        parent::__construct(sprintf('Wrong signature %s', $signature), $signatureService);
    }

    protected function getXmlGenerator(): AbstractIPayXmlGenerator
    {
        return new WrongSignatureErrorXmlGenerator();
    }
}
