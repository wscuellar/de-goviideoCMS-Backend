<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFormat;

class RegisterClientRequest extends FormRequest
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
            'name' => 'required|min:3',
            "email" => ['required','unique:users', new EmailFormat()] ,
            'password' => 'min:6|required|string|confirmed',
            'password_confirmation' => 'required',
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
        'name.required' => 'El nombre es requerido',
        'name.min' => 'El formato de nombre no es válido',
        'email.unique' => 'El email ya se encuentra registrado',
        "email.required" => "El email es requerido",
        "password.required" => "La contraseña es requerida",
        "password_confirmation.required" => "La confirmación de la contraseña es requerida",
        "password.min" => "La contraseña debe contener mínimo 6 caracteres",
        "password.confirmed" => "Las contraseñas ingresadas no son iguales",
        'terms.required' => 'Debe aceptar los términos y condiciones',
        'terms.accepted' => 'Debe aceptar los términos y condiciones',
    ];
    }
}
