<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ClientesServiciosCollection;
use App\Http\Resources\Servicios\ClienteServicioResource;
use App\Models\Servicios\ClienteServicio;
use stdClass;


class DashboardController extends Controller
{
    public function index(Request $request){

    	$totals = new stdClass;
    	$totals->gastos = 0;
		$totals->comisiones = 0;
		$totals->beneficios = 0;

    	$clientsServices = ClienteServicio::get(['gasto', 'comision', 'beneficio']);

    	foreach ($clientsServices  as $key => $value) {
    		
    		$totals->gastos =  $totals->gastos + 1*$value->gasto;
    		$totals->comisiones =  $totals->comisiones + 1*$value->comision;
    		$totals->beneficios =  $totals->beneficios + 1*$value->beneficio;
    	}


    	return json_encode($totals);
    }
}
