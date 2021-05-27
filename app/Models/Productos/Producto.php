<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\TipoProducto;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;


    public function tipoProducto(){
    	return $this->hasOne(TipoProducto::class, 'id', 'tipo_producto_id');
    } 
}
