<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
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
            'store_id' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|min:3',
            'release_date' => 'nullable|date',
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
            'store_id.required' => 'El Id del cliente es requerido',
            'brand_id.required' => 'El Id de la marca es requerido',
            'category_id.required' => 'El Id de la categoría es requerido',
            'name.min' => 'El formato de nombre no es válido',
            'name.required' => 'El nombre de la colección es requerido',
            'image.mimetypes' => 'Formato de imagen no válido',
            'image.max' => 'La imagen no debe tener más de 1024kb',
            'release_date.date' => 'Formato de fecha no válido'
         ];
    }
}
