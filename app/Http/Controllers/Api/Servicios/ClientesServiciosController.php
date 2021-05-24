<?php

namespace App\Http\Controllers\Api\Servicios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ClientesServiciosCollection;
use App\Http\Resources\Servicios\ClienteServicioResource;
use App\Models\Servicios\ClienteServicio;
use Illuminate\Pagination\LengthAwarePaginator ;
use Illuminate\Support\Arr;


class ClientesServiciosController extends Controller
{

	public function createPaginator($request,$items,$perPage){
        $perPage = 8;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $perPage;

        $items = array_reverse( Arr::sort($items , function ($value) {
            return $value['created_at'];
        }));
        $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);

        $itemsPaginated = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage,[
            'path' => $request->url(),
            'pageName' => 'page',
        ]);
        return $itemsPaginated;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $clientsServices = null;
        if ($request->isMethod("get")) {
          	$clientsServices = new ClientesServiciosCollection(ClienteServicio::orderBy('id', 'desc')
          		->with('cliente', 'servicio', 'productos', 'colaboradores')
          		->paginate(10));

          	
        
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'clientsServices' =>  $this->createPaginator($request, $clientsServices->items(), 8)
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
                $service = new ClienteServicio;
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
        $service = new ClienteServicioResource(ClienteServicio::findOrFail($id));
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
                $service =  ClienteServicio::findOrFail();
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
        $service =  ClienteServicio::findOrFail($id)->delete();
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
        $service =  ClienteServicio::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Delete Resource'
        ]);  
    }
}
