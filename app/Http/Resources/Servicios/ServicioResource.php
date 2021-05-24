<?php

namespace App\Http\Resources\Servicios;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
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
            "url"                       => url()->full()
        ];
    }
}
