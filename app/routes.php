<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');

// EXTERNAL ROUTES
Route::get('login','AuthController@getLogin');
Route::get('recuperar-password','AuthController@getRecoverPassword');
Route::get('recuperar-password/{hash}','AuthController@getRecoverHash');
Route::group(array('before' => 'csrf'), function(){
	Route::post('recuperar-password/{hash}/enviar','AuthController@postRecoverHash');
});
Route::group(array('before' => 'csrf'), function(){
	Route::post('login/enviar','AuthController@postLogin');
});
Route::group(array('before' => 'auth'), function(){
	Route::get('/','HomeController@getIndex');
	Route::get('cerrar-sesion','AuthController@getLogOut');

	Route::group(array('before' => 'administrador'), function(){
		//usuarios
		Route::get('administrador/nuevo-usuario','UserController@getNewUser');
		Route::get('administrador/ver-usuarios','UserController@getShowUsers');
		Route::get('administrador/ver-usuarios/{id}','UserController@getPasswordChange');
		//paquetes
		Route::get('administrador/nuevo-paquete','PackageController@getNewPackage');
		Route::get('administrador/ver-paquetes','PackageController@getShowPackages');
		Route::get('administrador/ver-paquetes/{id}','PackageController@getMdfPackage');
		Route::post('administrador/ver-paquetes/cambiar-status','PackageController@postChangeStatus');
		Route::post('administrador/ver-paquetes/cambiar-ubicacion','PackageController@postChangeLocation');
		Route::get('administrador/cargar-campos','PackageController@getFields');
		//remitentes
		Route::get('administrador/nuevo-remitente','AdminController@getNewShipper');
		Route::get('administrador/ver-remitentes','AdminController@getShowShippers');
		Route::get('administrador/ver-remitentes/{id}','AdminController@getMdfShipper');
		Route::get('administrador/ver-caracteristicas','PackageController@getCaracteristics');

		Route::post('administrador/ver-remitentes/eliminar','AdminController@postElimShipper');
		Route::group(array('before' => 'csrf'), function(){
			//usuerios
			Route::post('administrador/nuevo-usuario/enviar','UserController@postNewUser');
			Route::post('administrador/ver-usuarios/eliminar','UserController@postElimUser');
			Route::post('administrador/ver-usuario/{id}/enviar','UserController@postChangePass');
			Route::post('administrador/ver-usuario/cambiar-rol','UserController@postMdfRole');
			//paquete
			Route::post('administrador/nuevo-paquete/enviar','PackageController@postNewPackage');
			Route::post('administrador/ver-paquete/{id}/enviar','PackageController@postMdfPackage');
			Route::post('administrador/ver-paquetes/eliminar','PackageController@postElimPackage');
			//remitentes
			Route::post('administrador/nuevo-remitente/enviar','AdminController@postNewShipper');
			Route::post('administrador/ver-remitente/{id}/enviar','AdminController@postMdfShipper');

		});
	});
	Route::group(array('before' => 'cliente'), function(){
		Route::get('administrador/ver-paquetes/{type}','PackageController@getPackages');
		Route::get('administrador/ver-ubicacion','PackageController@getPackageLocations');
	});
	
});