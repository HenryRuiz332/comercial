<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ClientesServiciosCollection;
use App\Http\Resources\Servicios\ClienteServicioResource;
use App\Models\Servicios\ClienteServicio;
use App\Models\Servicios\MontoClienteServicio;

use App\Models\Gastos\Gasto;

use stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\Caducidad;
use App\Models\Gastos\TiposGasto;

class DashboardController extends Controller
{
    public function index(Request $request){

    	


    	$totals = new stdClass;
    	$totals->gastos = 0;
		$totals->comisiones = 0;
		$totals->beneficios = 0;
		$totals->expenses = 0;

    	 $clientsServices = ClienteServicio::with('monto')->get();

    	foreach ($clientsServices  as $key => $value) {
    		foreach ($value->monto as $monto) {
    			
    			$totals->gastos =  $totals->gastos + 1*$monto->gasto;
    			$totals->comisiones =  $totals->comisiones + 1*$monto->comision;
    			$totals->beneficios =  $totals->beneficios + 1*$monto->beneficio;
    		}
    		
    	}

    	$gastosGenerales = Gasto::get(['importe']);
    	$totalGG = 0; 
    	foreach ($gastosGenerales as $i) {
    		$totalGG = $totalGG + $i->importe;
    	}
    	$totals->expenses = $totalGG;



    	$expensesTypes =  TiposGasto::orderBy('nombre', 'desc')->get(['id', 'nombre']);

    	return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'totals' => $totals,
                'expensesTypes' => $expensesTypes
        ]);
    }

    public function filtersDate(Request $request){
       
        $cantidades = null;


        $desde = new \Carbon\Carbon($request->desde);
        $hasta = new \Carbon\Carbon($request->hasta);
        $tipo = $request->tipo;


        if ($request->isMethod("post")) {

            if ($tipo == 'not') {

                $cantidades =  MontoClienteServicio::where("fecha",">=",$desde)
                                                        ->where("aviso_permanencia","<=",$hasta)
                                                        ->orderBy('id', 'desc')
                                                        ->get();


                 $expensesG =Gasto::
                where("fecha",">=",$desde)
                ->where("fecha","<=",$hasta)
                ->orderBy('id', 'desc')->get();



            }
           

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'cantidades' => $cantidades,
                'expensesG' => $expensesG
               
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Get Request Error'
            ]);  
        }
    }
}
