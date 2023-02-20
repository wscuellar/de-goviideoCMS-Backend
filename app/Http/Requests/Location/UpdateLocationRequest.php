<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFormat;

class UpdateLocationRequest extends FormRequest
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
            "email" => ['required', new EmailFormat()] ,
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
            'name.min' => 'El formato de nombre no es válido',
            'name.required' => 'El nombre de la marca es requerido',
            "email.required" => "El email es requerido"
         ];
    }
}
