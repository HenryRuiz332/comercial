<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Main prefix routes v1
Route::group(['prefix' => 'v1'], function(){
		
		Route::group(['namespace' => 'Users'], function(){
			Route::resource('/collaborators', 'ColaboradoresController');
			Route::post('/collaborators-trash', 'ColaboradoresController@trash');
		});

	
		Route::group(['namespace' => 'Productos'], function(){
			Route::resource('/products-types', 'TiposProductosController');
			Route::post('/products-types-trash', 'TiposProductosController@trash');

			Route::resource('/products', 'ProductosController');
			Route::post('/products-trash', 'ProductosController@trash');
		});



		Route::group(['namespace' => 'Servicios'], function(){
			Route::resource('/services', 'ServiciosController');
			Route::post('/services-trash', 'ServiciosController@trash');
		});

		Route::group(['namespace' => 'Servicios'], function(){
			Route::resource('/clients-services', 'ClientesServiciosController');
			Route::post('/clients-services-trash', 'ClientesServiciosController@trash');
		});


});
//End prefix routes
