<?php


namespace Sun\IPay\Http\Responses;

use DOMElement;

class ServiceInfoResponse extends IPayResponse
{
    /**
     * @var int
     */
    private $orderId;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $name;

    public function __construct(int $orderId, float $amount, string $surname, string $name)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->amount = $amount;
        $this->surname = $surname;
        $this->name = $name;
    }

    protected function response()
    {
        $this->serviceProviderNode->appendChild($this->createServiceInfoNode());
    }

    private function createNameNode(): DOMElement
    {
        $surnameNode = $this->doc->createElement("Surname");
        $surnameNode->appendChild($this->doc->createTextNode($this->surname));
        $firstNameNode = $this->doc->createElement("FirstName");
        $firstNameNode->appendChild($this->doc->createTextNode($this->name));

        $nameNode = $this->doc->createElement("Name");
        $nameNode->appendChild($surnameNode);
        $nameNode->appendChild($firstNameNode);

        return $nameNode;
    }

    private function createDebtNode(string $amount): DOMElement
    {
        $debtNode = $this->doc->createElement("Debt");
        $debtNode->appendChild($this->doc->createTextNode($amount));

        return $debtNode;
    }

    private function createAmountNode(): DOMElement
    {
        $amountNode = $this->doc->createElement("Amount");
        $amountNode->setAttribute("Editable", "N");
        $amountNode->setAttribute("MinAmount", "0,1");
        $amountNode->setAttribute("MaxAmount", "10000");
        $amountNode->setAttribute("AmountPrecision", "0,01");

        $debtNode = $this->createDebtNode($this->amount);

        $amountNode->appendChild($debtNode);

        return $amountNode;
    }

    private function createServiceInfoNode(): DOMElement
    {
        $serviceInfoNode = $this->doc->createElement("ServiceInfo");

        $serviceInfoNode->appendChild($this->createAmountNode());
        $serviceInfoNode->appendChild($this->createNameNode());
        //TODO: localize
        $serviceInfoNode->appendChild($this->createInfoNode("Номер заказа: {$this->orderId}", "Пополнение счета"));

        return $serviceInfoNode;
    }
}
