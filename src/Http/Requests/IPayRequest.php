<?php

namespace Sun\IPay\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sun\IPay\Rules\SignatureRule;

class IPayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'XML' => ['required', new SignatureRule()],
        ];
    }
}
