<?php

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

Route::get('/departamento', function () {
	$de=\App\Modelo\Ubigeo::where("codProvincia",0)->where("codDistrito",0)->get();
    return $de;
});
Route::get('/provincia/{d}', function ($d) {
	$de=\App\Modelo\Ubigeo::where("dDepartamento",$d)->where("codDistrito",0)->get();
    return $de;
});
Route::get('/distrito/{d}/{p}', function ($d,$p) {
	$de=\App\Modelo\Ubigeo::where("dDepartamento",$d)->where("codProvincia",$p)->get();
    return $de;
});

Route::get('/peru-consultas/dni/{document_number}', 'Api\PeruConsultasController@queryByDNI')->name('peru-consultas-query-dni');
Route::get('/peru-consultas/ruc/{ruc}', 'Api\PeruConsultasController@queryByRUC')->name('peru-consultas-query-ruc');