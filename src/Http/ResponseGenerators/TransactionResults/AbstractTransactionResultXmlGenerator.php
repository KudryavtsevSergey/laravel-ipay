<?php

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

use DOMElement;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;

abstract class AbstractTransactionResultXmlGenerator extends AbstractIPayXmlGenerator
{
    public function __construct(
        private string $message,
    ) {
        parent::__construct();
    }

    protected function generateXml(): void
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
