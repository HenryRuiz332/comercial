<?php

namespace App\Http\Resources\Productos;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
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
            "tipo_producto_id"          => $this->tipo_producto_id,
            "nombre"                    => $this->nombre,
            "url"                       => url()->full()
        ];
    }
}
