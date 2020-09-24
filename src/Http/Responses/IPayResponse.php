<?php

namespace Sun\IPay\Http\Responses;

use DOMDocument;
use DOMElement;
use Sun\IPay\IPayConfig;

abstract class IPayResponse implements IPayResponseContract
{
    protected DOMDocument $doc;
    protected DOMElement $serviceProviderNode;

    public function __construct()
    {
        $this->doc = $this->createDoc();
        $this->serviceProviderNode = $this->createServiceProviderNode();
        $this->doc->appendChild($this->serviceProviderNode);
    }

    protected abstract function response();

    public function get()
    {
        $this->response();

        $xml = trim($this->doc->saveXML());

        $md5 = IPayConfig::getXmlSignature($xml);

        return response($xml)
            ->setCharset('windows-1251')
            ->header('Content-Type', 'text/xml')
            ->header('ServiceProvider-Signature: SALT+MD5', $md5);
    }

    private function createServiceProviderNode(): DOMElement
    {
        return $this->doc->createElement('ServiceProvider_Response');
    }

    private function createDoc(): DOMDocument
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;

        return $doc;
    }

    /**
     * @param string|array $messages
     * @return DOMElement
     */
    protected function createInfoNode($messages): DOMElement
    {
        $messages = is_string($messages) ? func_get_args() : $messages;

        $infoNode = $this->doc->createElement("Info");
        $infoNode->setAttribute("xml:space", "preserve");

        array_walk($messages, function (string $message) use ($infoNode) {
            $infoLineNode = $this->doc->createElement("InfoLine");
            $infoLineNode->appendChild($this->doc->createTextNode($message));

            $infoNode->appendChild($infoLineNode);
        });

        return $infoNode;
    }
}
