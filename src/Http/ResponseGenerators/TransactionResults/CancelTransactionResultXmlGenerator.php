<?php

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

class CancelTransactionResultXmlGenerator extends AbstractTransactionResultXmlGenerator
{
    public function __construct()
    {
        parent::__construct(__('ipay::messages.operation_cancelled'));
    }
}
