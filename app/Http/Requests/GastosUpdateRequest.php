<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosUpdateRequest extends FormRequest
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
        return [
            'importe' => 'required',
            'fecha' => 'required',
            'tipo_de_gasto_id' => 'required',
        ];
    }
     public function messages(){
        return [
            'importe.required' => 'Campo requerido',
            'fecha.required' => 'Campo requerido',
            'tipo_de_gasto_id.required' => 'Campo requerido',
        ];
    }
}
