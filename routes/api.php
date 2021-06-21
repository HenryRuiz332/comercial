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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::post('/logout', 'Auth\AuthController@logout');

//Main prefix routes v1
Route::group(['prefix' => 'v1', ['middleware' => ['auth:sanctum']] ], function(){
		
		Route::get('/dashboard', 'DashboardController@index');


		Route::group(['namespace' => 'Users'], function(){

			Route::resource('/users', 'UsersController');
			Route::post('/users-trash/{id}', 'UsersController@trash');
			Route::put('/users-update-services/{idServices}', 'UsersController@updateService');
			Route::post('/user-whatsapp-message', 'UsersController@whatsAppMessage');


			Route::resource('/collaborators', 'ColaboradoresController');
			Route::post('/collaborators-trash/{id}', 'ColaboradoresController@trash');
		});

	
		Route::group(['namespace' => 'Productos'], function(){
			Route::resource('/products-types', 'TiposProductosController');
			Route::post('/products-types-trash/{id}', 'TiposProductosController@trash');

			Route::resource('/products', 'ProductosController');
			Route::post('/products-trash/{id}', 'ProductosController@trash');
		});



		Route::group(['namespace' => 'Servicios'], function(){
			Route::resource('/services', 'ServiciosController');
			Route::post('/services-trash/{id}', 'ServiciosController@trash');
		});

		Route::group(['namespace' => 'Servicios'], function(){
			Route::resource('/clients-services', 'ClientesServiciosController');
			Route::post('/clients-services-trash/{id}', 'ClientesServiciosController@trash');

			Route::get('/clients-services-aux/', 'ClientesServiciosController@indexAux');
			
			Route::post('/clients-services-doc/{id}', 'ClientesServiciosController@saveDoc');
			Route::post('/clients-services-trash-imagen/{id}', 'ClientesServiciosController@deleteDoc');
			Route::post('/clients-services-trash-images/{id}', 'ClientesServiciosController@deleteAllDocs');

		});



		Route::group(['namespace' => 'Gastos'], function(){
			Route::resource('/gTypes', 'TiposGastosController');
			Route::post('/gTypes-trash/{id}', 'TiposGastosController@trash');


			Route::resource('/gastos', 'GastosController');
			Route::post('/gastos-trash/{id}', 'GastosController@trash');
			Route::post('gastos-filter-date',  'GastosController@dateFilter');
		});


		Route::group(['namespace' => 'Messages'], function(){
			
			Route::resource('send-messages',  'MessagesController');
		});



});
//End prefix routes
