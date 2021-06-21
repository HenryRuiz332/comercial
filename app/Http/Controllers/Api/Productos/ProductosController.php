<?php

namespace App\Http\Controllers\Api\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Productos\ProductosCollection;
use App\Http\Resources\Productos\ProductoResource;
use App\Models\Productos\Producto;
use App\Models\Productos\TipoProducto;
use DB;
use App\Traits\Paginate;
use App\Http\RequestS\ProductosCreateRequest;
use App\Http\RequestS\ProductosUpdateRequest;
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
            $products = new ProductosCollection(Producto::with('tipoProducto')->orderBy('id', 'desc')->paginate(10));
            $productsTypes = TipoProducto::get(['id', 'nombre']);

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'productos' => Paginate::createPaginator($request, $products->items(), 8),
                'tiposProductos'  => $productsTypes
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
        $product = null;
        if ($request->isMethod("post")) {
            try {
                $product = new Producto;
                $product->tipo_producto_id = $request->tipo_producto_id;
                $product->nombre = strtoupper($request->nombre);
                $product->saveOrfail();   
            } catch (\Throwable $th) {

                $product->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'producto' => $product
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
        $product = null;
        if ($request->isMethod("put")) {
            try {
                $product =  Producto::findOrFail($id);
                $product->tipo_producto_id = $request->tipo_producto_id;
                $product->nombre = strtoupper($request->nombre);
                $product->update();   
            } catch (\Throwable $th) {

            }

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'productos' => $product
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
        $product =  Producto::findOrFail($id)->delete();
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
        $product =  Producto::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Resource Deleted'
        ]);
    }
}
