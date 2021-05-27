<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Colaboradores\ColaboradoresCollection;
use App\Http\Resources\Colaboradores\ColaboradorResource;
use App\Models\Users\Colaborador;
use DB;
use App\Traits\Paginate;

class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collaborators = null;
        if ($request->isMethod("get")) {
            $collaborators = new ColaboradoresCollection(Colaborador::orderBy('id', 'desc')->paginate(10));
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'colaboradores' => Paginate::createPaginator($request, $collaborators->items(), 8),
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
        $collaborator = null;
        if ($request->isMethod("post")) {
            try {
                $collaborator = new Colaborador;
                $collaborator->nombre = $request->nombre;
                $collaborator->telefono = $request->telefono;
                $collaborator->saveOrfail();   
            } catch (\Throwable $th) {

                $collaborator->forceDelete();
                DB::rollBack();
                throw $th;
            }

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'colaborador' => $collaborator
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
        $collaborator = new ColaboradorResource(Colaborador::findOrFail($id));
        return response()->json([
            'status' => 200,
            'message' => 'Resource Successfull',
            'colaborador' => $collaborator
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
        $collaborator = null;
        if ($request->isMethod("put")) {
            
                $collaborator =  Colaborador::findOrFail($id);
                $collaborator->nombre = $request->nombre;
                $collaborator->telefono = $request->telefono;
                $collaborator->update();   
           

            return response()->json([
                'status' => 200,
                'message' => 'Save Succesfull',
                'colaborador' => $collaborator
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
        $collaborator =  Colaborador::findOrFail($id)->delete();
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
        $collaborator =  Colaborador::findOrFail($id)->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Delete Resource'
        ]);  
    }
}
