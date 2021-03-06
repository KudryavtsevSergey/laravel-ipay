<?php

namespace Sun\IPay\Http\ResponseGenerators;

use DOMElement;
use Sun\IPay\Contracts\IPayAmountContract;
use Sun\IPay\Contracts\IPayOrderInfoContract;

class ServiceInfoXmlGenerator extends AbstractIPayXmlGenerator
{
    private IPayOrderInfoContract $orderInfo;
    private IPayAmountContract $amount;

    public function __construct(IPayOrderInfoContract $orderInfo, IPayAmountContract $amount)
    {
        parent::__construct();
        $this->orderInfo = $orderInfo;
        $this->amount = $amount;
    }

    protected function generateXml()
    {
        $this->serviceProviderNode->appendChild($this->createServiceInfoNode());
    }

    private function createNameNode(): DOMElement
    {
        $payer = $this->orderInfo->getPayer();

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
        $debtNode = $this->createDebtNode($this->amount->getAmount());

        $amountNode->appendChild($debtNode);

        return $amountNode;
    }

    private function createServiceInfoNode(): DOMElement
    {
        $serviceInfoNode = $this->doc->createElement('ServiceInfo');

        $serviceInfoNode->appendChild($this->createAmountNode());
        $serviceInfoNode->appendChild($this->createNameNode());
        //TODO: localize
        $message = sprintf('Номер заказа: %s', $this->orderInfo->getOrderId());
        $serviceInfoNode->appendChild($this->createInfoNode($message, 'Пополнение счета'));

        return $serviceInfoNode;
    }
}
