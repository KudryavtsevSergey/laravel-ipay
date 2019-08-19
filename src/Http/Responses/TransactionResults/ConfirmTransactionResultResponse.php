<?php

namespace Sun\IPay\Http\Responses\TransactionResults;

class ConfirmTransactionResultResponse extends TransactionResultResponse
{
    public function __construct()
    {
        //TODO: localize
        parent::__construct("Спасибо за покупку!");
    }
}
