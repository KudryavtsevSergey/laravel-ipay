<?php

namespace Sun\IPay\Exceptions\Request;

use Illuminate\Contracts\Support\Responsable;
use Sun\IPay\Exceptions\InternalError;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Service\SignatureService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

abstract class AbstractResponsableException extends InternalError implements Responsable
{
    private SignatureService $signatureService;

    public function __construct(string $message, SignatureService $signatureService, Throwable $previous = null)
    {
        parent::__construct($message, $previous);
        $this->signatureService = $signatureService;
    }

    public function toResponse($request): Response
    {
        return (new IPayResponse($this->getXmlGenerator(), $this->signatureService))->toResponse($request);
    }

    protected abstract function getXmlGenerator(): AbstractIPayXmlGenerator;
}
