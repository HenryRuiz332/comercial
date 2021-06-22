<?php

namespace App\Http\Controllers\Api\Gastos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Traits\Paginate;
use App\Http\Requests\GastosCreateRequest;
use App\Http\Requests\GastosUpdateRequest;
use App\Models\Gastos\Gasto;
use App\Models\Gastos\TiposGasto;
use App\Http\Resources\Gastos\GastosCollection;


class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = null;
        if ($request->isMethod("get")) {
            $expenses = new GastosCollection(Gasto::with('tipoGasto')->orderBy('id', 'desc')->paginate(10));
            $expensesTypes =  TiposGasto::orderBy('nombre', 'desc')->get(['id', 'nombre']);

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'expenses' => Paginate::createPaginator($request, $expenses->items(), 8),
                'expensesTypes' => $expensesTypes
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Get Request Error'
            ]);  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastosCreateRequest $request)
    {
       
        $expense = null;
        if ($request->isMethod("post")) {
            try {
                $expense = new Gasto;
                $expense->tipo_de_gasto_id = $request->tipo_de_gasto_id;
                $expense->fecha = $request->fecha;
                $expense->importe = $request->importe;
                $expense->descripcion = $request->descripcion;
                $expense->saveOrfail();   
            } catch (\Throwable $th) {

                $expense->forceDelete();
                DB::rollBack();
                throw $th;
            }

            $expense['tipo_gasto'] = '';
            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'expense' => $expense
            ]);

        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Request Error'
            ]);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GastosUpdateRequest $request, $id)
    {
        $expense = null;
        if ($request->isMethod("put")) {
           
                $expense =  Gasto::findOrFail($id);
                $expense->tipo_de_gasto_id = $request->tipo_de_gasto_id;
                $expense->fecha = $request->fecha;
                $expense->importe = $request->importe;
                $expense->descripcion = $request->descripcion;
                $expense->update();   
           

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'expense' => $expense
            ]);
            
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Request Error'
            ]);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $expense =  Gasto::findOrFail($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Send Resource Trash'
        ]);  
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *
     *Forzar Borrado. Borrado de la papelera
     */
    public function destroy($id)
    {
       $expense =  Gasto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }



    public function dateFilter(Request $request, $value='')
    {
        $expenses = null;


        $desde = new \Carbon\Carbon($request->desde);
        $hasta = new \Carbon\Carbon($request->hasta);
        $tipo = $request->tipo;
        if ($request->isMethod("post")) {

            if ($tipo == 'not') {
                 $expenses = new GastosCollection(Gasto::with('tipoGasto')
                ->where("fecha",">=",$desde)
                ->where("fecha","<=",$hasta)
                ->orderBy('id', 'desc')->paginate(10));
            }else{
                 $expenses = new GastosCollection(Gasto::with('tipoGasto')
                ->where("fecha",">=",$desde)
                ->where("fecha","<=",$hasta)
                ->where('tipo_de_gasto_id', $request->tipo)
                ->orderBy('id', 'desc')->paginate(10));
            }
           

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'expenses' => Paginate::createPaginator($request, $expenses->items(), 8),
               
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Get Request Error'
            ]);  
        }
    }
}

