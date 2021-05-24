<?php

namespace App\Http\Controllers\Api\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Productos\ProductosCollection;
use App\Http\Resources\Productos\ProductoResource;
use App\Models\Productos\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = null;
        if ($request->isMethod("get")) {
            $products = new ProductosCollection(Producto::orderBy('id', 'desc')->paginate(10));
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'productos' => $products
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
        $products = null;
        if ($request->isMethod("post")) {
            try {
                $products = new Producto;
                $products->tipo_producto_id = $request->tipoProductoId;
                $products->nombre = $request->nombre;
                $products->saveOrfail();   
            } catch (\Throwable $th) {

                $products->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'productos' => $products
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
        $producto = new ProductoResource(Producto::findOrFail($id));
        return response()->json([
            'status' => 200,
            'message' => 'Product Successfull',
            'producto' => $producto
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
        $products = null;
        if ($request->isMethod("post")) {
            try {
                $products =  Producto::findOrFail($id);
                $products->tipo_producto_id = $request->tipoProductoId;
                $products->nombre = $request->nombre;
                $products->update();   
            } catch (\Throwable $th) {

            }

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'productos' => $products
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
        $products =  Producto::findOrFail($id)->delete();
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
        $products =  Producto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }
}
