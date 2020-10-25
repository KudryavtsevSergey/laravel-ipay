<?php

namespace Sun\IPay\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\IPayConfig;
use Symfony\Component\HttpFoundation\Response;

class IPayResponse implements Responsable
{
    private IPayConfig $config;
    private AbstractIPayXmlGenerator $generator;

    public function __construct(AbstractIPayXmlGenerator $generator, IPayConfig $config)
    {
        $this->generator = $generator;
        $this->config = $config;
    }

    public function toResponse($request): Response
    {
        $xml = $this->generator->generateResponse();
        $md5 = $this->config->getXmlSignature($xml);

        return response($xml)
            ->setCharset('windows-1251')
            ->header('Content-Type', 'text/xml')
            ->header('ServiceProvider-Signature: SALT+MD5', $md5);
    }
}
