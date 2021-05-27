<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Users\UsersCollection;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator ;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use DB;


class UsersController extends Controller
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
        $users = null;
        if ($request->isMethod("get")) {
            $users = new UsersCollection(User::orderBy('id', 'desc')->paginate(10));
            
            return response()->json([
                'status' => 200,
                'message' => 'Data Succesfull',
                'users' =>  $this->createPaginator($request, $users->items(), 8)
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

        $user = null;
        if ($request->isMethod("post")) {
            try {
                $user = new User;
                $user->nombre = $request->nombre;
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
    public function update(Request $request, $id)
    {
        $user = null;
        if ($request->isMethod("put")) {
            $user =  User::findOrFail($id);
            $user->nombre = $request->nombre;
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



}
