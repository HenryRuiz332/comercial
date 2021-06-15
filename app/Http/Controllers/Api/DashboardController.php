<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ClientesServiciosCollection;
use App\Http\Resources\Servicios\ClienteServicioResource;
use App\Models\Servicios\ClienteServicio;
use App\Models\Gastos\Gasto;

use stdClass;


class DashboardController extends Controller
{
    public function index(Request $request){

    	$totals = new stdClass;
    	$totals->gastos = 0;
		$totals->comisiones = 0;
		$totals->beneficios = 0;
		$totals->expenses = 0;

    	$clientsServices = ClienteServicio::get(['gasto', 'comision', 'beneficio']);

    	foreach ($clientsServices  as $key => $value) {
    		
    		$totals->gastos =  $totals->gastos + 1*$value->gasto;
    		$totals->comisiones =  $totals->comisiones + 1*$value->comision;
    		$totals->beneficios =  $totals->beneficios + 1*$value->beneficio;
    	}

    	$gastosGenerales = Gasto::get(['importe']);
    	$totalGG = 0; 
    	foreach ($gastosGenerales as $i) {
    		$totalGG = $totalGG + $i->importe;
    	}
    	$totals->expenses = $totalGG;
    	return json_encode($totals);
    }
}
