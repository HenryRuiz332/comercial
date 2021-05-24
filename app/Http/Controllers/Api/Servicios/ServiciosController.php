<?php

namespace App\Http\Controllers\Api\Servicios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ServiciosCollection;
use App\Http\Resources\Servicios\ServicioResource;
use App\Models\Servicios\Servicio;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = null;
        if ($request->isMethod("get")) {
            $services = new ServiciosCollection(Servicio::orderBy('id', 'desc')->paginate(10));
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'productos' => $services
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
        $service = null;
        if ($request->isMethod("post")) {
            try {
                $service = new Servicio;
                $service->nombre = $request->nombre;
                $service->telefono = $request->telefono;
                $service->saveOrfail();   
            } catch (\Throwable $th) {

                $service->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'productos' => $service
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
        $service = new ServicioResource(Servicio::findOrFail($id));
        return response()->json([
            'status' => 200,
            'message' => 'Resource Successfull',
            'Servicio' => $service
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
        $service = null;
        if ($request->isMethod("post")) {
            try {
                $service =  Servicio::findOrFail();
                $service->nombre = $request->nombre;
                $service->telefono = $request->telefono;
                $service->update();   
            } catch (\Throwable $th) {

            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'productos' => $service
            ]);

        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Request Error'
            ]);  
        }
    }



    public function trash($id)
    {
        $service =  Servicio::findOrFail($id)->delete();
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
     */
    public function destroy($id)
    {
        $service =  Servicio::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Delete Resource'
        ]);  
    }
}
