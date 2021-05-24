<?php

namespace App\Http\Controllers\Api\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Productos\TiposProductosCollection;
use App\Http\Resources\Productos\TipoProductoResource;
use App\Models\Productos\TipoProducto;

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
                'tiposProductos' => $productTypes
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
        $productTypes = null;
        if ($request->isMethod("post")) {
            try {
                $productTypes = new TipoProducto;
                $productTypes->nombre = $request->nombre;
                $productTypes->saveOrfail();   
            } catch (\Throwable $th) {

                $productTypes->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'tiposProductos' => $productTypes
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
        $productTypes = null;
        if ($request->isMethod("post")) {
            try {
                $productTypes =  TipoProducto::findOrFail($id);
                $productTypes->nombre = $request->nombre;
                $productTypes->update();   
            } catch (\Throwable $th) {

            }

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'tiposProductos' => $productTypes
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
        $productTypes =  TipoProducto::findOrFail($id)->delete();
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
       $productTypes =  TipoProducto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }
}
