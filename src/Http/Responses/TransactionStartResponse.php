<?php

namespace Sun\IPay\Http\Responses;

use DOMElement;

class TransactionStartResponse extends IPayResponse
{
    private int $orderId;

    public function __construct(int $orderId)
    {
        parent::__construct();
        $this->orderId = $orderId;
    }

    protected function response()
    {
        $this->serviceProviderNode->appendChild($this->createTransactionStartNode());
    }

    private function createTransactionStartNode(): DOMElement
    {
        $transactionStartNode = $this->doc->createElement("TransactionStart");

        $transactionStartNode->appendChild($this->createServiceProviderTrxIdNode());
        //TODO: localize
        $transactionStartNode->appendChild($this->createInfoNode("Номер заказа: {$this->orderId}", "Пополнение счета"));

        return $transactionStartNode;
    }

    private function createServiceProviderTrxIdNode(): DOMElement
    {
        $serviceProviderTrxIdNode = $this->doc->createElement("ServiceProvider_TrxId");
        $serviceProviderTrxIdNode->appendChild($this->doc->createTextNode($this->orderId));

        return $serviceProviderTrxIdNode;
    }
}
