<?php

namespace App\Http\Requests\Concessionaire;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConcessionaireRequest extends FormRequest
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
            'name.required' => 'El nombre del concesionario es requerido',
        ];
    }
}
