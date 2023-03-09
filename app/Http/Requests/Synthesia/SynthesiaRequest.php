<?php

namespace App\Http\Requests\Synthesia;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFormat;

class SynthesiaRequest extends FormRequest
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
            'title' => 'required|min:2',
            'visibility' => ['required', 'in:public,private'],
            "callback_email" => ['required', new EmailFormat()] ,
            'avatar' => 'required',
            'script_text' => 'required',
            'voice' => 'required',
            'background' => 'required',
            'horizontal_aling' => ['required','in:left,center,right'],
            "style" => ['required','in:rectangular,circular'],
            "scale" => ['required','numeric','min:0.5','max:1'],
            "test" =>  ['required','in:true,false'],
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
            'title.min' => 'El formato del titulo no es válido, requiere al menos 2 caracteres',
            'title.required' => 'El titulo del video es requerido',
            'visibility.required' => 'La visibilidad del video es requerido',
            'visibility.in' => 'Parametro de visibilidad no es válido (public, private)',
            "callback_email.required" => "El email es requerido",
            "avatar.required" => "El avatar es requerido",
            "script_text.required" => "El texto es requerido",
            "voice.required" => "La voz del avatar es requerida",
            "background.required" => "La imagen de fondo es requerida",
            "horizontal_aling.required" => "La alineación horizontal es requerida",
            "horizontal_aling.in" => "La alineación horizontal no es válida (left, center, right)",
            "style.required" => "El estilo es requerido",
            "style.in" => "El estilo no es válido (rectangular, circular)",
            "scale.required" => "La escala es requerida",
            "scale.numeric" => "La escala debe ser un número",
            "scale.min" => "La escala debe estar entre 0.5 y 1",
            "scale.max" => "La escala debe estar entre 0.5 y 1",
            "test" => "El test es requerido",
            "test.in" => "El test no es válido (true, false)",
         ];
    }
}
