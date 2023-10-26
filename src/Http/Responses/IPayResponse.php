<?php

declare(strict_types=1);

namespace Sun\IPay\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Service\SignatureService;
use Symfony\Component\HttpFoundation\Response;

class IPayResponse implements Responsable
{
    public function __construct(
        private readonly AbstractIPayXmlGenerator $generator,
        private readonly SignatureService $signatureService,
    ) {
    }

    public function toResponse($request): Response
    {
        $xml = $this->generator->generateResponse();
        $signature = $this->signatureService->generate($xml);

        return (new Response($xml, headers: [
            'Content-Type' => 'text/xml',
            'ServiceProvider-Signature' => sprintf('SALT+MD5%s', $signature),
        ]))->setCharset('windows-1251');
    }
}
