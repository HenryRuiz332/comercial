<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteServicioCreateRequest extends FormRequest
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
            // 'editarObj.user_id' => 'required|numeric',
            // 'editarObj.servicio_id' => 'required|numeric',
            // 'producto_id' => 'numeric',
            // 'colaborador_id' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'editarObj.user_id.required' => 'El servicio a contratar debe asignarse a un cliente',
            'editarObj.user_id.numeric' => 'Error script x789',

            'editarObj.servicio_id.required' => 'El servicio es requerido',
            'editarObj.servicio_id.numeric' => 'Error script x789',

            // 'producto_id.numeric' => 'Error script x789',
            // 'colaborador_id.numeric' => 'Error script x789',
        ];
    }
}
