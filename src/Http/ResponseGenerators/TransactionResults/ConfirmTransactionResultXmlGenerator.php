<?php

declare(strict_types=1);

namespace Sun\IPay\Http\ResponseGenerators\TransactionResults;

class ConfirmTransactionResultXmlGenerator extends AbstractTransactionResultXmlGenerator
{
    public function __construct()
    {
        parent::__construct(__('ipay::messages.thanks'));
    }
}
