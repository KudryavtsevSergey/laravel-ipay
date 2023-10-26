<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators;

use DOMElement;
use Sun\IPay\Dto\RequestDto\TransactionStartRequestDto;

class TransactionStartXmlGenerator extends AbstractIPayXmlGenerator
{
    public function __construct(
        private readonly TransactionStartRequestDto $transactionStart,
        private readonly string $transactionId,
    ) {
        parent::__construct();
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
        $serviceProviderTrxIdNode->appendChild($this->doc->createTextNode($this->transactionId));

        return $serviceProviderTrxIdNode;
    }
}
