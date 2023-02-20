<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFormat;

class StoreUpdateRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [

            'name' => 'required|min:3',
            "email" => ['required', new EmailFormat()] ,
            'url' => 'required|url',
            'image' => [
				'nullable','file',
				'mimetypes:image/png,image/jpg,image/jpeg,image/webp,image/gif,image/cvg',
				'max:4096'
			],
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
            'name.required' => 'El nombre es requerido',
            "email.required" => "El email es requerido",
            'url.required' => 'La web es requerida',
            'url.url' => 'El formato de web no es válido',
            'image.mimetypes' => 'Formato de imagen no válido',
            'image.max' => 'La imagen no debe tener más de 1024kb'
         ];
    }
}
