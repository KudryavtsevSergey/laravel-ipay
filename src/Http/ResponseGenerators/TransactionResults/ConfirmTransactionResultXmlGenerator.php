<?php

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

class ConfirmTransactionResultXmlGenerator extends AbstractTransactionResultXmlGenerator
{
    public function __construct()
    {
        //TODO: localize
        parent::__construct('Спасибо за покупку!');
    }
}
