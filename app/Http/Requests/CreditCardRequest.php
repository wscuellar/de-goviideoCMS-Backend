<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CreditCardDateFormat;
use App\Rules\CreditCardNumberFormat;
use App\Rules\CreditCardCVCFormat;
use App\Rules\FirstandLastNameFormat;

class CreditCardRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => ["required", 'min:6', new FirstandLastNameFormat()],
            "value" => ['required', new CreditCardNumberFormat()] ,
            "type" => 'required',
            "date" => ['required', new CreditCardDateFormat()],
            "num" =>  ['required', new CreditCardCVCFormat()],
            'address' => 'required|min:6',
            'terms' => ['accepted', 'required']
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required" => "Campo requerido",
            'name.min' => 'Formato del nombre no es válido',
            "value.required" => "Campo requerido",
            "type.required" => "Campo requerido",
            "date.required" => "Campo requerido",
            "num.required" => "Campo requerido",
            'address.required' => 'La dirección es requerida',
            'address.min' => 'Formato de dirección no es válido',
            'terms.required' => 'Debe aceptar los términos y condiciones',
            'terms.accepted' => 'Debe aceptar los términos y condiciones',
           ];
    }
}
