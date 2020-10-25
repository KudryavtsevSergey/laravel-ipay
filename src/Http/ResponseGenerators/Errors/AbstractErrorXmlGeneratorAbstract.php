<?php

namespace Sun\IPay\Http\ResponseGenerators\Errors;

use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;

abstract class AbstractErrorXmlGenerator extends AbstractIPayXmlGenerator
{
    protected function generateXml()
    {
        $this->serviceProviderNode->appendChild($this->createErrorNode());
    }

    private function createErrorNode()
    {
        $errorNode = $this->doc->createElement('Error');
        $errorLineNode = $this->doc->createElement('ErrorLine');
        $errorLineNode->appendChild($this->doc->createTextNode($this->getErrorMessage()));
        $errorNode->appendChild($errorLineNode);

        return $errorNode;
    }

    protected abstract function getErrorMessage(): string;
}
