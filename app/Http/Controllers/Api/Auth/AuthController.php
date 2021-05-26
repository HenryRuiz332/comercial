<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     public function login(Request $request){
          $user = User::where('email', $request->email)->first();

          if (!$user || !Hash::check($request->password, $user->password)) {
               return response(['message' => ['These credentials do not match our records.']], 404);
          }

          $token = $user->createToken('my-app-token')->plainTextToken;

          $response = ['user' => $user, 'token' => $token];

          return response($response, 201);
     }

     public function logout(Request $request){
          if($request->user()){
               return $request->user()->tokens()->delete();
          }
          return response()->json('logout', 200);  
     }
}
