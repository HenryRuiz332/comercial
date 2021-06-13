<?php

namespace App\Http\Controllers\Api\Gastos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Traits\Paginate;
use App\Http\RequestS\TGastosCreateRequest;
use App\Http\RequestS\TGastosUpdateRequest;
use App\Models\Gastos\TiposGasto;

class TiposGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expensesTypes = null;
        if ($request->isMethod("get")) {
            $expensesTypes =  TiposGasto::orderBy('nombre', 'desc')->paginate(10);

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'expensesTypes' => Paginate::createPaginator($request, $expensesTypes->items(), 8)
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
    public function store(TGastosCreateRequest $request)
    {
        $expenseType = null;
        if ($request->isMethod("post")) {
            try {
                $expenseType = new TiposGasto;
                $expenseType->nombre = strtoupper($request->nombre);
                $expenseType->saveOrfail();   
            } catch (\Throwable $th) {

                $expenseType->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'expenseType' => $expenseType
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
    public function update(TGastosUpdateRequest $request, $id)
    {
        $expenseType = null;
        if ($request->isMethod("put")) {
           
                $expenseType =  TiposGasto::findOrFail($id);
                $expenseType->nombre = strtoupper($request->nombre);
                $expenseType->update();   
           

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'expenseType' => $expenseType
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
        $expenseType =  TiposGasto::findOrFail($id)->delete();
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
       $expenseType =  TiposGasto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }
}
