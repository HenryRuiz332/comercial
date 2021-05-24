<?php

namespace App\Http\Resources\Colaboradores;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ColaboradoresCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($collaborators){
                return [
                    "id"                        => $collaborators->id,
                    "nombre"                    => $collaborators->nombre,
                    "telefono"                  => $collaborators->telefono,
                    "url"                       => url()->full()
                ];
            })

        ];
    }
}
