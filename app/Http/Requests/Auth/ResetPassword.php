<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Rules\EmailFormat;

class ResetPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            "email" => ['required', new EmailFormat()] ,
            'password' => 'required|min:6|string|confirmed',
            'token' => 'required|string'
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
            'email.required' => 'El email es requerido',
            'email.exists' => 'El email no existe',
            'password.required' => 'La contraseña es requerida',
            "password.min" => "La contraseña debe contener mínimo 6 caracteres",
            "password_confirmation.required" => "La confirmación de la contraseña es requerida",
            "password_confirmation.min" => "La contraseña debe contener mínimo 6 caracteres",
            "password.confirmed" => "Las contraseñas ingresadas no son iguales",
            'token.required' => 'El token es requerido',

        ];
    }

    protected  function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }
}
