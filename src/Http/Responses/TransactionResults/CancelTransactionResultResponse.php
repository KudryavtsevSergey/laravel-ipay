<?php

namespace Sun\IPay\Http\Responses\TransactionResults;

class CancelTransactionResultResponse extends TransactionResultResponse
{
    public function __construct()
    {
        //TODO: localize
        parent::__construct("Операция отменена.");
    }
}
