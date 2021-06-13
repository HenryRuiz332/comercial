<?php

namespace App\Models\Gastos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gastos\TiposGasto;

class Gasto extends Model
{
    use HasFactory;


    public function tipoGasto(){
        return $this->hasOne(TiposGasto::class, 'id', 'tipo_de_gasto_id');
    }
}
