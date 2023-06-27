<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators;

use DOMDocument;
use DOMElement;
use Sun\IPay\Exceptions\InternalError;

abstract class AbstractIPayXmlGenerator
{
    protected DOMDocument $doc;
    protected DOMElement $serviceProviderNode;

    public function __construct()
    {
        $this->doc = $this->createDoc();
        $this->serviceProviderNode = $this->createServiceProviderNode();
        $this->doc->appendChild($this->serviceProviderNode);
    }

    protected abstract function generateXml(): void;

    public function generateResponse(): string
    {
        $this->generateXml();

        return trim($this->doc->saveXML() ?: throw new InternalError('Error xml generation'));
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

    protected function createInfoNode(string ...$messages): DOMElement
    {
        $infoNode = $this->doc->createElement('Info');
        $infoNode->setAttribute('xml:space', 'preserve');

        foreach ($messages as $message) {
            $infoLineNode = $this->doc->createElement('InfoLine');
            $infoLineNode->appendChild($this->doc->createTextNode($message));

            $infoNode->appendChild($infoLineNode);
        }

        return $infoNode;
    }
}
