<?php

namespace Sun\IPay\Http\ResponseGenerators;

use DOMElement;
use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;

class TransactionStartXmlGenerator extends AbstractIPayXmlGenerator
{
    private TransactionStartRequestDto $transactionStart;

    public function __construct(TransactionStartRequestDto $transactionStart)
    {
        parent::__construct();
        $this->transactionStart = $transactionStart;
    }

    protected function generateXml(): void
    {
        $this->serviceProviderNode->appendChild($this->createTransactionStartNode());
    }

    private function createTransactionStartNode(): DOMElement
    {
        $transactionStartNode = $this->doc->createElement('TransactionStart');

        $transactionStartNode->appendChild($this->createServiceProviderTrxIdNode());
        $message = __('ipay::messages.order_number', ['order_id' => $this->transactionStart->getPersonalAccount()]);
        $transactionStartNode->appendChild($this->createInfoNode($message, __('ipay::messages.refill')));

        return $transactionStartNode;
    }

    private function createServiceProviderTrxIdNode(): DOMElement
    {
        $serviceProviderTrxIdNode = $this->doc->createElement('ServiceProvider_TrxId');
        $serviceProviderTrxIdNode->appendChild($this->doc->createTextNode($this->transactionStart->getPersonalAccount()));

        return $serviceProviderTrxIdNode;
    }
}
