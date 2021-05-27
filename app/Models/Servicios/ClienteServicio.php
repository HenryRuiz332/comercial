<?php

namespace App\Models\Servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Servicios\Servicio;
use App\Models\Productos\Producto;
use App\Models\Users\Colaborador;


class ClienteServicio extends Model
{
    use HasFactory;
    protected $table = "clientes_servicios";
    protected $primaryKey = "id";


    public function cliente(){
    	return $this->hasOne(User::class, "id", "user_id");
    }

    public function servicio(){
    	return $this->hasOne(Servicio::class, "id", "servicio_id");
    }

    public function producto(){
    	return $this->hasOne(Producto::class, "id", "producto_id");
    }

    public function colaborador(){
        return $this->hasOne(Colaborador::class, "id", "colaborador_id");
    }

}
