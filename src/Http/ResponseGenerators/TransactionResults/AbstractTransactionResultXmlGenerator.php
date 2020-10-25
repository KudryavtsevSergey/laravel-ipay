<?php

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

use DOMElement;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;

abstract class AbstractTransactionResultXmlGenerator extends AbstractIPayXmlGenerator
{
    private string $message;

    public function __construct(string $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    protected function generateXml()
    {
        $this->serviceProviderNode->appendChild($this->createTransactionResultNode());
    }

    private function createTransactionResultNode(): DOMElement
    {
        $transactionResultNode = $this->doc->createElement('TransactionResult');

        $transactionResultNode->appendChild($this->createInfoNode($this->message));

        return $transactionResultNode;
    }
}
