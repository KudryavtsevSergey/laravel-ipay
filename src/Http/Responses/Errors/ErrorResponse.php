<?php

namespace Sun\IPay\Http\Responses\Errors;

use Sun\IPay\Http\Responses\IPayResponse;

abstract class ErrorResponse extends IPayResponse
{
    protected function response()
    {
        $this->serviceProviderNode->appendChild($this->createErrorNode());
    }

    private function createErrorNode()
    {
        $errorNode = $this->doc->createElement("Error");
        $errorLineNode = $this->doc->createElement("ErrorLine");
        $errorLineNode->appendChild($this->doc->createTextNode($this->getErrorMessage()));
        $errorNode->appendChild($errorLineNode);

        return $errorNode;
    }

    protected abstract function getErrorMessage(): string;
}
