<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrearDisplayRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $decimal = "required|numeric|between:0,99.99";
        return [
            "name" => "required",
            "company_id" => "integer|required",
            "latitude" => $decimal,
            "longitude" => $decimal,
            "type" => [
                'required',
                Rule::in(['indoor', 'outdoor']),
            ],
            "price" => $decimal,
        ];
    }

    public function messages()
    {
        return [
            "required" => "Este campo es requerido",
            "integer" => "El campo es requerido",
            "numeric" => "El campo debe ser un valor numerico",
            "type" => "Seleccione un tipo"

        ];  
    }
}
