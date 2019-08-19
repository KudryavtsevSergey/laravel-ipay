<?php

namespace Sun\IPay\Http\Responses\TransactionResults;

use DOMElement;
use Sun\IPay\Http\Responses\IPayResponse;

abstract class TransactionResultResponse extends IPayResponse
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
        $this->serviceProviderNode->appendChild($this->createTransactionResultNode());
    }

    private function createTransactionResultNode(): DOMElement
    {
        $transactionResultNode = $this->doc->createElement("TransactionResult");

        $transactionResultNode->appendChild($this->createInfoNode($this->message));

        return $transactionResultNode;
    }
}
