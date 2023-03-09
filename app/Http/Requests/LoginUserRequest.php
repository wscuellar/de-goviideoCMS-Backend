<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFormat;

class LoginUserRequest extends FormRequest
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
            "email" => ['required', new EmailFormat()] ,
            "password" => "required|min:6|max:30",
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
            "email.required" => "El email es requerido",
            "password.required" => "La contraseña es requerida",
            "password.min" => "La contraseña debe contener mínimo 6 caracteres",
           ];
    }

    //https://styde.net/como-trabajar-con-form-requests-en-laravel/
}
