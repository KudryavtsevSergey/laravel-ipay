<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators;

use DOMElement;
use Sun\IPay\Contracts\IPayOrderInfoContract;

class ServiceInfoXmlGenerator extends AbstractIPayXmlGenerator
{
    public function __construct(
        private readonly IPayOrderInfoContract $orderInfo,
    ) {
        parent::__construct();
    }

    protected function generateXml(): void
    {
        $this->serviceProviderNode->appendChild($this->createServiceInfoNode());
    }

    private function createNameNode(): DOMElement
    {
        $payer = $this->orderInfo->getIPayPayer();

        $surnameNode = $this->doc->createElement('Surname');
        $surnameNode->appendChild($this->doc->createTextNode($payer->getSurname()));
        $firstNameNode = $this->doc->createElement('FirstName');
        $firstNameNode->appendChild($this->doc->createTextNode($payer->getName()));

        $nameNode = $this->doc->createElement('Name');
        $nameNode->appendChild($surnameNode);
        $nameNode->appendChild($firstNameNode);

        return $nameNode;
    }

    private function createDebtNode(string $amount): DOMElement
    {
        $debtNode = $this->doc->createElement('Debt');
        $debtNode->appendChild($this->doc->createTextNode($amount));

        return $debtNode;
    }

    private function createAmountNode(): DOMElement
    {
        $amountNode = $this->doc->createElement('Amount');
        $debtNode = $this->createDebtNode((string)$this->orderInfo->calculateIPayAmount()->getAmount());

        $amountNode->appendChild($debtNode);

        return $amountNode;
    }

    private function createServiceInfoNode(): DOMElement
    {
        $serviceInfoNode = $this->doc->createElement('ServiceInfo');

        $serviceInfoNode->appendChild($this->createAmountNode());
        $serviceInfoNode->appendChild($this->createNameNode());
        $message = __('ipay::messages.order_number', ['order_id' => $this->orderInfo->getIPayOrderId()]);
        $serviceInfoNode->appendChild($this->createInfoNode($message, __('ipay::messages.refill')));

        return $serviceInfoNode;
    }
}
