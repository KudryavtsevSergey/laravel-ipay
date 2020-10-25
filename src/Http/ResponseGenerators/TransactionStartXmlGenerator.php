<?php

namespace Sun\IPay\Http\ResponseGenerators;

use DOMElement;
use Sun\IPay\Models\TransactionStart;

class TransactionStartXmlGenerator extends AbstractIPayXmlGenerator
{
    private TransactionStart $transactionStart;

    public function __construct(TransactionStart $transactionStart)
    {
        parent::__construct();
        $this->transactionStart = $transactionStart;
    }

    protected function generateXml()
    {
        $this->serviceProviderNode->appendChild($this->createTransactionStartNode());
    }

    private function createTransactionStartNode(): DOMElement
    {
        $transactionStartNode = $this->doc->createElement('TransactionStart');

        $transactionStartNode->appendChild($this->createServiceProviderTrxIdNode());
        //TODO: localize
        $message = sprintf('Номер заказа: %s', $this->transactionStart->getPersonalAccount());
        $transactionStartNode->appendChild($this->createInfoNode($message, 'Пополнение счета'));

        return $transactionStartNode;
    }

    private function createServiceProviderTrxIdNode(): DOMElement
    {
        $serviceProviderTrxIdNode = $this->doc->createElement('ServiceProvider_TrxId');
        $serviceProviderTrxIdNode->appendChild($this->doc->createTextNode($this->transactionStart->getPersonalAccount()));

        return $serviceProviderTrxIdNode;
    }
}
