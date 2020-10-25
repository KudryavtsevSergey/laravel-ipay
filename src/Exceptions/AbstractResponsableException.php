<?php

namespace Sun\IPay\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\IPayConfig;

abstract class AbstractResponsableException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return new IPayResponse($this->getXmlGenerator(), new IPayConfig());
    }

    protected abstract function getXmlGenerator(): AbstractIPayXmlGenerator;
}
