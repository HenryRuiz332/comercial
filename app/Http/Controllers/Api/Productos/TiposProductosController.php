<?php

namespace App\Http\Controllers\Api\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Productos\TiposProductosCollection;
use App\Http\Resources\Productos\TipoProductoResource;
use App\Models\Productos\TipoProducto;
use App\Traits\Paginate;

class TiposProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productTypes = null;
        if ($request->isMethod("get")) {
            $productTypes = new TiposProductosCollection(TipoProducto::orderBy('id', 'desc')->paginate(10));
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'tiposProductos' => Paginate::createPaginator($request, $productTypes->items(), 8)
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
    public function store(Request $request)
    {
        $productType = null;
        if ($request->isMethod("post")) {
            try {
                $productType = new TipoProducto;
                $productType->nombre = $request->nombre;
                $productType->saveOrfail();   
            } catch (\Throwable $th) {

                $productType->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'tipoProducto' => $productType
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
        $productType = new TipoProductoResource(TipoProducto::findOrFail($id));
        return response()->json([
            'status' => 200,
            'message' => 'Type Product Successfull',
            'tipoProducto' => $productType
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productType = null;
        if ($request->isMethod("put")) {
           
                $productType =  TipoProducto::findOrFail($id);
                $productType->nombre = $request->nombre;
                $productType->update();   
           

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'tipoProducto' => $productType
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
     *
     *
     *Mover a la papelera. Borrado lógico
     */
    public function trash($id)
    {
        $productType =  TipoProducto::findOrFail($id)->delete();
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
       $productType =  TipoProducto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }
}
