<?php

namespace App\Http\Resources\Servicios;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiciosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'data' => $this->collection->transform(function($services){
                return [
                    "id"                        => $services->id,
                    "nombre"                    => $services->nombre,
                    "url"                       => url()->full()
                ];
            })

        ];
    }
}
