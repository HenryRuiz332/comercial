<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Users\UsersCollection;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\Paginate;
use Illuminate\Support\Str;
use DB;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Productos\Producto;
use App\Models\Users\Colaborador;
use App\Models\Servicios\ClienteServicio;
use App\Models\Servicios\MontoClienteServicio;


class UsersController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = null;
        if ($request->isMethod("get")) {
            $users = new UsersCollection(User::with('clienteServicio.servicio','clienteServicio.producto', 'clienteServicio.colaborador', 'clienteServicio.monto')->orderBy('id', 'desc')->paginate(500));
            
            $products = Producto::get(['id', 'nombre']);
            $collaborators = Colaborador::get(['id', 'nombre']);

            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'users' => Paginate::createPaginator($request, $users->items(), 8),
                'products' => $products,
                'collaborators' => $collaborators,

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
    public function store(UserCreateRequest $request)
    {

        $user = null;
        if ($request->isMethod("post")) {
            try {
                $user = new User;
                $user->nombre = strtoupper($request->nombre);
                $user->telefono = $request->telefono;
                $user->cif = $request->cif;
                $user->gasto = $request->gasto;
                $user->nota_gasto = $request->nota_gasto;
                $user->beneficio = $request->beneficio;
                $user->email = $request->email;

                $password = Str::random(10);
                // echo $password;
                $user->password  = Hash::make($password);
                $user->saveOrfail();

                return response()->json([
                    'status' => 200,
                    'message' => 'Save Succesfull',
                    'user' => $user
                ]);
            } catch (\Throwable $th) {

                $user->forceDelete();
                DB::rollBack();
                throw $th;
            }

            

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
        $user = new UserResource(User::findOrFail($id));
        return response()->json([
            'status' => 200,
            'message' => 'Resource Successfull',
            'User' => $user
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = null;
        if ($request->isMethod("put")) {
            $user =  User::findOrFail($id);
            $user->nombre = strtoupper($request->nombre);
            $user->telefono = $request->telefono;
            $user->cif = $request->cif;
            $user->gasto = $request->gasto;
            $user->nota_gasto = $request->nota_gasto;
            $user->beneficio = $request->beneficio;
            $user->email = $request->email;
            $user->update();   

            return response()->json([
                'status' => 200,
                'message' => 'Update Succesfull',
                'user' => $user
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
        $user =  User::findOrFail($id)->delete();
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
        $user =  User::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Delete Resource'
        ]);  
    }


    ##################
    ##################



    public function updateService(Request $request, $id){
        
        $user = $request->user;
        $serviceRequest = $request->service;

        $service = null;
        if ($request->isMethod("put")) {
            
                $service =  ClienteServicio::findOrFail($id);
                $service->user_id = $serviceRequest['user_id'];
                $service->servicio_id = $serviceRequest['servicio_id'];
                $service->producto_id = $serviceRequest['producto_id'];
                $service->colaborador_id = $serviceRequest['colaborador_id'];
                $service->gasto = $serviceRequest['gasto'];

                $service->nota_gasto = $serviceRequest['nota_gasto'];

                $service->beneficio = $serviceRequest['beneficio'];
                $service->comision = $serviceRequest['comision'];
                $service->aviso_permanencia = $serviceRequest['aviso_permanencia'];
                $service->notas = $serviceRequest['notas'];
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

    public function updateMontos(Request $request){

        $service = $request;
        $montos = $request->monto;

        $montosEliminar = MontoClienteServicio::where('cliente_servicio_id', $service->id)->get();
        if (count($montosEliminar) > 0) {

            foreach ($montosEliminar as  $value) {
                MontoClienteServicio::findOrFail($value['id'])->delete();
            }

            foreach ($montos as  $monto) {
                if ($monto['gasto'] == "") {
                    $monto['gasto'] = null;
                }
                if ($monto['comision'] == "") {
                    $monto['comision'] = null;
                }
                if ($monto['beneficio'] == "") {
                    $monto['beneficio'] = null;
                }
                if ($monto['aviso_permanencia'] == "") {
                    $monto['aviso_permanencia'] = null;
                }
                if ($monto['fecha'] == "") {
                    $monto['fecha'] = null;
                }
               $newMount =  new MontoClienteServicio;
               $newMount->cliente_servicio_id = $service['id'];
               $newMount->gasto = $monto['gasto'];
               $newMount->comision = $monto['comision'];
               $newMount->beneficio = $monto['beneficio'];
               $newMount->aviso_permanencia = $monto['aviso_permanencia'];
               $newMount->fecha = $monto['fecha'];
               $newMount->saveOrfail();
            }
        }elseif(count($montos) == 0 && count($montosEliminar) > 0){
            foreach ($montosEliminar as  $value) {
                MontoClienteServicio::findOrFail($value['id'])->delete();
            }
        }else{
            foreach ($montos as  $monto) {
                if ($monto['gasto'] == "") {
                    $monto['gasto'] = null;
                }
                if ($monto['comision'] == "") {
                    $monto['comision'] = null;
                }
                if ($monto['beneficio'] == "") {
                    $monto['beneficio'] = null;
                }
                if ($monto['aviso_permanencia'] == "") {
                    $monto['aviso_permanencia'] = null;
                }
                 if ($monto['fecha'] == "") {
                    $monto['fecha'] = null;
                }
               $newMount =  new MontoClienteServicio;
               $newMount->cliente_servicio_id = $service['id'];
               $newMount->gasto = $monto['gasto'];
               $newMount->comision = $monto['comision'];
               $newMount->beneficio = $monto['beneficio'];
               $newMount->aviso_permanencia = $monto['aviso_permanencia'];
               $newMount->fecha = $monto['fecha'];
               $newMount->saveOrfail();
            }
        }
        
        return response()->json([

            'message' => 'Actualizado'
        ]);
        
    }
    public function ir(){
        return;
    }
}
