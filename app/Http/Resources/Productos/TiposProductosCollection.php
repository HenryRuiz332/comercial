<?php

namespace App\Http\Resources\Productos;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TiposProductosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        //return parent::toArray($request);
        return [

            'data' => $this->collection->transform(function($productTypes){
                return [
                    "id"          => $productTypes->id,
                    "nombre"      => $productTypes->nombre,
                    "url"         => url()->full()
                ];
            })

        ];
    }
}