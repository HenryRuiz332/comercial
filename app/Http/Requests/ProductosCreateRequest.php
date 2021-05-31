<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosCreateRequest extends FormRequest
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
            'tipo_producto_id' => 'required|numeric',
            'nombre' => 'required|min:4|max:101|string|unique:productos'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe ser mayor a 3 carácteres',
            'nombre.max' => 'El nombre debe ser menor a 100 carácteres',
            'nombre.unique' => 'El producto ya existe',

            'tipo_producto_id.required' => 'El tipo de producto es requerido'
        ];
    }
}
