<?php

namespace App\Http\Resources\Colaboradores;

use Illuminate\Http\Resources\Json\JsonResource;

class ColaboradorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "id"                        => $this->id,
            "nombre"                    => $this->nombre,
            "telefono"                  => $this->telefono,
            "url"                       => url()->full()
        ];
    }
}
