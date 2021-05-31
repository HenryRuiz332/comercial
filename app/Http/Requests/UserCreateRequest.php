<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:100', 
            'telefono' => 'required|min:9|max:9|unique:users',
            'cif' => 'max:15',
            'email' => 'max:100',

            'gasto' => 'between:0,99.99',
            'beneficio' => 'between:0,99.99',
            'nota_gasto' => 'max:400',
            
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe ser mayor a 3 carácteres',
            'nombre.max' => 'El nombre debe ser menor a 100 carácteres',
            

            'telefono.required' => 'El teléfono es requerido',
            'telefono.min' => 'El teléfono debe tener 9 carárcteres',
            'telefono.max' => 'El teléfono debe tener 9 carárcteres',
            'telefono.unique' => 'El teléfono ya existe',

            'cif.unique' => 'El número de CIF ya existe en nuestro sistema',
            'cif.max' => 'El número de CIF máximo 15 carácteres',

            'beneficio.between' => 'Valor incorrecto'

            
        ];
    }
}
