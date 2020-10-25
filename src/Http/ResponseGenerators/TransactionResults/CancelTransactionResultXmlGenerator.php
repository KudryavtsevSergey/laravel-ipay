<?php

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

class CancelTransactionResultXmlGenerator extends AbstractTransactionResultXmlGenerator
{
    public function __construct()
    {
        //TODO: localize
        parent::__construct('Операция отменена.');
    }
}
