<?php

namespace Sun\IPay\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Service\SignatureService;
use Symfony\Component\HttpFoundation\Response;

class IPayResponse implements Responsable
{
    private AbstractIPayXmlGenerator $generator;
    private SignatureService $signatureService;

    public function __construct(AbstractIPayXmlGenerator $generator, SignatureService $signatureService)
    {
        $this->generator = $generator;
        $this->signatureService = $signatureService;
    }

    public function toResponse($request): Response
    {
        $xml = $this->generator->generateResponse();
        $signature = $this->signatureService->generate($xml);

        return response($xml)
            ->setCharset('windows-1251')
            ->header('Content-Type', 'text/xml')
            ->header('ServiceProvider-Signature: SALT+MD5', $signature);
    }
}
