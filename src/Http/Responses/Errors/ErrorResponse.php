<?php

namespace Sun\IPay\Http\Responses\Errors;

use Sun\IPay\Http\Responses\IPayResponse;

abstract class ErrorResponse extends IPayResponse
{
    /**
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    protected function response()
    {
        $this->serviceProviderNode->appendChild($this->createErrorNode());
    }

    private function createErrorNode()
    {
        $errorNode = $this->doc->createElement("Error");
        $errorLineNode = $this->doc->createElement("ErrorLine");
        $errorLineNode->appendChild($this->doc->createTextNode($this->message));
        $errorNode->appendChild($errorLineNode);

        return $errorNode;
    }
}
