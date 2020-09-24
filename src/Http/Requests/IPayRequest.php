<?php

namespace Sun\IPay\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sun\IPay\IPayConfig;
use Sun\IPay\Rules\SignatureRule;

class IPayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'XML' => ['required', new SignatureRule()],
        ];
    }
}
