<?php

namespace App\Http\Resources\Servicios;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientesServiciosCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function($clientsServices){
                return [
                    "id"                            => $clientsServices->id,
                    "user_id"                       => $clientsServices->user_id,
                    "servicio_id"                       => $clientsServices->servicio_id,
                    "producto_id"                        => $clientsServices->producto_id,
                    "colaborador_id"                        => $clientsServices->colaborador_id,
                    "gasto"                        => $clientsServices->gasto,
                    "nota_gasto"                        => $clientsServices->nota_gasto,
                    "beneficio"                        => $clientsServices->beneficio,
                    "comision"                        => $clientsServices->comision,
                    "aviso_permanencia"                        => $clientsServices->aviso_permanencia,
                    "notas"                        => $clientsServices->notas,
                    "documento"                        => $clientsServices->documento,
                    "url"                           => url()->full(),

                    // "cliente"                           => with($clientsServices->user),
                    // "servicio"                           => with($clientsServices->service),
                    // "productos"                           => with($clientsServices->product),
                ];
            }),
            
           

        ];
    }
}
