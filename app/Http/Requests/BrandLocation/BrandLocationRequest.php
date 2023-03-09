<?php

namespace App\Http\Requests\BrandLocation;

use Illuminate\Foundation\Http\FormRequest;

class BrandLocationRequest extends FormRequest
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
            'brand_id' => 'required',
            'location_id' => 'required',
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
            'brand_id.required' => 'El Id de la marca es requerido',
            'location_id.required' => 'El id del concesionario es requerido'
         ];
    }
}
