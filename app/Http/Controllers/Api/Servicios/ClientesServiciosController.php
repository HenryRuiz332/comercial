<?php

namespace App\Http\Controllers\Api\Servicios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Servicios\ClientesServiciosCollection;
use App\Http\Resources\Servicios\ClienteServicioResource;
use App\Models\Servicios\ClienteServicio;
use DB;
use App\Traits\Paginate;
use App\Models\User;
use App\Models\Users\Colaborador;
use App\Models\Servicios\Servicio;
use App\Models\Productos\Producto;

use App\Http\Requests\ClienteServicioCreateRequest;
use App\Http\Requests\ClienteServicioUpdateRequest;
use App\Traits\HandlerFiles;

class ClientesServiciosController extends Controller
{

	

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
          		->with('cliente', 'servicio', 'producto', 'colaborador')
          		->paginate(10));

          	$clients = User::get(['id', 'nombre']);
            $services = Servicio::get(['id', 'nombre']);
        
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'clientsServices' =>  Paginate::createPaginator($request, $clientsServices->items(), 8),
                'services' => $services,
                'clients' => $clients
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Get Request Error'
            ]);  
        }
    }

    public function indexAux(Request $request){
        $products = Producto::get(['id', 'nombre']);
        $collaborators = Colaborador::get(['id', 'nombre']);
        return response()->json([
                'status' => 2000,
                'message' => 'Data Succesfull',
                'products' => $products,
                'collaborators' => $collaborators

        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteServicioCreateRequest $request)
    {

        if ($request->isMethod("post")) {
            try {
                $service = new ClienteServicio;
                $service->user_id = $request->user_id;
                $service->servicio_id = $request->servicio_id;
                $service->producto_id = $request->producto_id;
                $service->colaborador_id = $request->colaborador_id;
                $service->gasto = $request->gasto;

                $service->nota_gasto = $request->nota_gasto;

                $service->beneficio = $request->beneficio;
                $service->comision = $request->comision;
                $service->aviso_permanencia = $request->aviso_permanencia;
                $service->notas = $request->notas;
                $service->saveOrfail();   
            } catch (\Throwable $th) {

                $service->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'service' => $service
            ]);

        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Post Request Error'
            ]);  
        }
    }
    protected function pathServer(){
        $PATH = $_SERVER['DOCUMENT_ROOT'];
        $pathPublicOut = explode('public',$PATH);
        $res = $pathPublicOut[0]; 
        return $res;
    }
    public function doc(Request $request){

        $destination = $this->pathServer() . 'storage/app/public/docs';



        $store = HandlerFiles::store($request,  $destination);

       

        $archivo = $store->original['nombresArchivos'][0];
       
        $service =  ClienteServicio::findOrFail($request->id);
        $service->documento =  $archivo;
        $service->update();

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
            'service' => $service
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteServicioUpdateRequest $request, $id)
    {
        $service = null;
        if ($request->isMethod("put")) {
            
                $service =  ClienteServicio::findOrFail($id);
                $service->user_id = $request->user->id;
                $service->servicio_id = $request->servicio_id;
                $service->producto_id = $request->producto_id;
                $service->colaborador_id = $request->colaborador_id;
                $service->gasto = $request->gasto;

                $service->nota_gasto = $request->nota_gasto;

                $service->beneficio = $request->beneficio;
                $service->comision = $request->comision;
                $service->aviso_permanencia = $request->aviso_permanencia;
                $service->notas = $request->notas;
                $service->update();   
           
            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'service' => $service
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
