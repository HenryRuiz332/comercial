<?php

namespace App\Http\Resources\Servicios;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteServicioResource extends JsonResource
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
            "id"                             => $this->id,
            "user_id"                        => $this->user_id,
            "servicio_id"                    => $this->servicio_id,
            "producto_id"                    => $this->producto_id,
            "colaborador_id"                 => $this->colaborador_id,
            "gasto"                          => $this->gasto,
            "nota_gasto"                     => $this->nota_gasto,
            "beneficio"                      => $this->beneficio,
            "comision"                       => $this->comision,
            "aviso_permanencia"              => $this->aviso_permanencia,
            "notas"                          => $this->notas,
            "url"                            => url()->full()
        ];
    }
}
