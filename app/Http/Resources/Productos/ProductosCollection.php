<?php

namespace App\Http\Resources\Productos;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductosCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function($product){
                return [
                    "id"                        => $product->id,
                    "tipo_producto_id"          => $product->tipo_producto_id,
                    "nombre"                    => $product->nombre,
                    "url"                       => url()->full()
                ];
            })

        ];
    }
}
