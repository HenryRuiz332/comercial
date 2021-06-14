<?php

namespace App\Http\Resources\Gastos;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GastosCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function($expenses){
                return [
                    "id"                        => $expenses->id,
                    "tipo_de_gasto_id"          => $expenses->tipo_de_gasto_id,
                    "importe"                   => $expenses->importe,
                    "fecha"                     => $expenses->fecha,
                    "descripcion"               => $expenses->descripcion,
                    "total"                     => 900,
                    "url"                       => url()->full()
                ];
            })

        ];
    }

}
