<?php 

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','empresa'])->group(function () {

	Route::post('/uusuario/{i}', 'Control\CUsuario@uusuario')->name('uusuario');
	Route::post('/uusuario_empresa/{i}', 'Control\CUsuario@uusuario_empresa')->name('uusuario_empresa');

});

Route::middleware(['auth','empresa'])->group(function () {

	Route::post('/susuario', 'Control\CUsuario@susuario')->name('susuario');
	Route::post('/susuario_empresa', 'Control\CUsuario@susuario_empresa')->name('susuario_empresa');

});

Route::middleware(['auth','admin','verified','empresa'])->group(function () {

	Route::get('/lusuario', 'Control\CUsuario@lusuario')->name('lusuario');

	Route::get('/pusuario/{id}', 'Control\CUsuario@pusuario')->name('pusuario');

	Route::get('/dusuario/{id}', 'Control\CUsuario@dusuario')->name('dusuario');

	Route::get('/ausuario/{id}', 'Control\CUsuario@ausuario')->name('ausuario');

	Route::get('/putipo/{id}', 'Control\CUsuario@putipo')->name('putipo');

	Route::get('/uutipo/{id}', 'Control\CUsuario@uutipo')->name('uutipo');

});

Route::post('/save-user-operacion-manual', 'Control\CUsuario@saveUserOperacionManual')->name('save-user-operacion-manual');

Route::middleware(['auth'])->group(function () {
	Route::get('/user-already-exists/{dni}', function($dni) {
		return response()->json([
			'exists' => \App\Modelo\Usuario::where([["nrodocumento", $dni], ['personal', 1]])->exists()
		]);
	})->name('user-already-exists');

	Route::get('/userempresa-already-exists/{ruc}', function($ruc) {
		return response()->json([
			'exists' => \App\Modelo\Usuario::where([["ruc", $ruc], ['empresa', 1]])->exists()
		]);
	})->name('userempresa-already-exists');
});
?>