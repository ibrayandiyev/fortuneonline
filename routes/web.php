<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Modelo\Operacion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	if(Auth::check()){
		return redirect('home');
	}
	else{
		return redirect('auth');
	}
});

Route::get("/auth",function(){
	if(Auth::check()){
		return redirect('home');
	}
	else{
		return view('auth.auth');
	}
});

require_once('ruta/usuario.php');
require_once('ruta/cambio.php');
require_once('ruta/cuenta.php');
require_once('ruta/operacion.php');

Route::middleware(['auth','empresa'])->group(function () {
	Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
	Route::get('/ayuda', 'Control\Vista@ayuda')->name('ayuda')->middleware('verified');
	Route::get('/perfil', 'Control\Vista@perfil')->name('perfil');
	Route::get('/cuentasbancarias', 'Control\Vista@cuentasbancarias')->name('cuentasbancarias')->middleware('verified');
	Route::get('/usuario', 'Control\Vista@usuario')->name('usuario');
	Route::get('/personal_o_empresa', 'Control\Vista@personal_o_empresa')->name('personal_o_empresa');
	Route::get('/usuario_empresa', 'Control\Vista@usuario_empresa')->name('usuario_empresa');
});
Route::middleware(['auth','admin','verified','empresa'])->group(function () {
	Route::get('/reportesbs', 'Control\Vista@reportesbs')->name('reportesbs');
	Route::get('/reporte', 'Control\Vista@reporte')->name('reporte');
	Route::get('/empresa', 'Control\Vista@empresa')->name('empresa');
	Route::get('/tipocambio', 'Control\Vista@tipocambio')->name('tipocambio');
	
	// Route::get('/lbancos', 'Control\CBancos@bancos')->name('lbancos');
	// Route::post('/bancos/update', 'Control\CBancos@update')->name('bancos.update');

	// Route::get('/lcodigosdescuento', 'Control\CCodigoDescuento@codigosdescuento')->name('lcodigosdescuento');
	// Route::post('/codigosdescuento/store', 'Control\CCodigoDescuento@store')->name('codigos_descuento.store');
	// Route::post('/codigosdescuento/update', 'Control\CCodigoDescuento@update')->name('codigos_descuento.update');
});
Route::middleware(['auth','usuario','verified','empresa'])->group(function () {		
	Route::get('/operacion', 'Control\Vista@operacion')->name('operacion');
	Route::get('/historial', 'Control\Vista@historial')->name('historial');
});
Auth::routes(['verify' => true]);

Route::get("/sbs",function(){
	$ls=\App\Modelo\Operacion::with("cuentabancariae","cuentabancariat","cuentabancariad","cuentabancariat","monedae","monedad","usuario")->where("estado",2)->get();
	return $ls;
});

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BalanceReportExport;
use Illuminate\Support\Facades\Password;

Route::middleware(['auth','verified','admin'])->group(function () {
	Route::get('/noperacionyvouchers/{id}', function($id){
		$ope = Operacion::select('voucher', 'voucher2', 'voucher3', 'voucher4', 'num_ope', 'num_ope2', 'num_ope3', 'num_ope4')->find($id);

		return view("admin.noperacionesyvouchers", compact("ope"));
	})->name('noperacionyvouchers');
	
	// Route::get('/reporte-caja', function() {
	// 	return view('admin.reportecaja');
	// })->name('reporte-caja');

	// Route::post('/reporte-caja/save', function(Request $request) {
	// 	Cache::put('initial_box_pen', $request->initial_box_pen, 60 * 60 * 24);
	// 	Cache::put('initial_box_dol', $request->initial_box_dol, 60 * 60 * 24);
	// 	return redirect()->back();
	// })->name('reporte-caja-save');

	// Route::get('/reporte-caja/reset', function() {
	// 	Cache::put('initial_box_pen', 0, 60 * 60 * 24);
	// 	Cache::put('initial_box_dol', 0, 60 * 60 * 24);
	// 	return redirect()->back();
	// })->name('reporte-caja-reset');

	// Route::get('/reporte-caja/download', function() {
	// 	return Excel::download(new BalanceReportExport(), 'balance.xlsx', null, [\Maatwebsite\Excel\Excel::XLSX]);
	// })->name('reporte-caja-download');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->middleware('guest')->name('password.reset');

Route::post('/custom-reset-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

	return response()->json([
		'success' => $status === Password::RESET_LINK_SENT,
	]);
})->middleware('guest')->name('custom-reset-password');

use Illuminate\Support\Facades\Artisan;
Route::get('/config/clear/dev', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    echo "<a href='https://sistema.fortuneonline.com.pe/'>Ir al inicio</a>";
});

// Route::get('/api.json', function () {
// 	$tc=\App\Modelo\Tipocambio::orderBy('tipocambio_id', 'DESC')->first();
// 	$dt = new \DateTime($tc->created_at);
//     return response()->json([
// 		'compra' => $tc->compra,
// 		'venta' => $tc->venta,
// 		'fecha' => $dt->format('Y/m/d')
// 	]);
// });

/*
//Endpoints to get data for migration in sistema.fortuneonline.com.pe
Route::get("/migrate/cuentas-bancarias",function(){
	$cuentasBancarias = App\Modelo\Cuentabancaria::orderBy("cuentabancaria_id", "ASC")->get();
	return response()->json($cuentasBancarias);
});

Route::get("/migrate/operaciones",function(){
	$operaciones = App\Modelo\Operacion::orderBy("operacion_id", "ASC")->get();
	return response()->json($operaciones);
});

Route::get("/migrate/usuarios",function(){
	$usuarios = App\Modelo\Usuario::orderBy("usuario_id", "ASC")->get();
	return response()->json($usuarios);
});
*/

/*
// Used in localhost to migrate data to new database
use GuzzleHttp\Client;
Route::get("/migrate/cuentas-bancarias",function(){
	$client = new Client();
	$res = $client->request(
		'GET', 
		"https://sistema.fortuneonline.com.pe/fortunec/public/migrate/cuentas-bancarias"
	);

	$data = json_decode($res->getBody());

	try {
		foreach($data as $d){
			$cuentaBancaria = new \App\Modelo\Cuentabancaria();
			$cuentaBancaria->cuentabancaria_id = $d->cuentabancaria_id;
			$cuentaBancaria->usuario_id = $d->usuario_id;
			$cuentaBancaria->banco_id = $d->banco_id;
			$cuentaBancaria->tipocuenta_id = $d->tipocuenta_id;
			$cuentaBancaria->moneda_id = $d->moneda_id;
			$cuentaBancaria->nrocuenta = $d->nrocuenta;
			$cuentaBancaria->alias = $d->alias;
			$cuentaBancaria->cuentapropia = 1;

			$cuentaBancaria->save();
		}

		return "MIGRATED";
	}catch(\Exception $e){
		return "ERROR: " . $e->getMessage();
	}
});

Route::get("/migrate/operaciones",function(){
	$client = new Client();
	$res = $client->request(
		'GET', 
		"https://sistema.fortuneonline.com.pe/fortunec/public/migrate/operaciones"
	);

	$data = json_decode($res->getBody());

	try {
		foreach($data as $d){
			$operacion = new \App\Modelo\Operacion();
			$operacion->operacion_id = $d->operacion_id;
			$operacion->cuentabancariae_id = $d->cuentabancariae_id;
			$operacion->cuentabancariad_id = $d->cuentabancariad_id;
			$operacion->monto = $d->monto;
			$operacion->moneda_id = $d->moneda_id;
			$operacion->tmoneda_id = $d->tmoneda_id;
			$operacion->cuentabancariat_id = $d->cuentabancariat_id;
			$operacion->voucher = $d->voucher;
			$operacion->cambio = $d->cambio;
			$operacion->taza = $d->taza;
			$operacion->usuario_id = $d->usuario_id;
			$operacion->created_at = $d->created_at;
			$operacion->updated_at = $d->updated_at;
			$operacion->estado = $d->estado;
			$operacion->last_user = $d->last_user;

			$operacion->save();
		}

		return "MIGRATED";
	}catch(\Exception $e){
		return "ERROR: " . $e->getMessage();
	}
});

Route::get("/migrate/usuarios",function(){
	$client = new Client();
	$res = $client->request(
		'GET', 
		"https://sistema.fortuneonline.com.pe/fortunec/public/migrate/usuarios"
	);

	$data = json_decode($res->getBody());

	try {
		foreach($data as $d){
			$usuario = new \App\Modelo\Usuario();
			$usuario->usuario_id = $d->usuario_id;
			$usuario->tiposdocumento_id = $d->tiposdocumento_id;
			$usuario->nrodocumento = $d->nrodocumento;
			$usuario->pais_id = $d->pais_id;
			$usuario->primernombre = $d->primernombre;
			$usuario->segundonombre = $d->segundonombre;
			$usuario->primeroapellido = $d->primeroapellido;
			$usuario->segundoapellido = $d->segundoapellido;
			$usuario->fecnacimiento = $d->fecnacimiento;
			$usuario->paisdireccion_id = $d->paisdireccion_id;
			$usuario->departamento_id = $d->departamento_id;
			$usuario->provincia_id = $d->provincia_id;
			$usuario->distrito_id = $d->distrito_id;
			$usuario->Direccion = $d->Direccion;
			$usuario->ocupacion_id = $d->ocupacion_id;
			$usuario->personaexpuesta = $d->personaexpuesta;
			$usuario->personal = $d->personal;
			$usuario->empresa = $d->empresa;
			$usuario->ruc = $d->ruc;
			$usuario->razon_social = $d->razon_social;
			$usuario->giro_negocio = $d->giro_negocio;
			$usuario->telefono = $d->telefono;
			$usuario->correo_electronico = $d->correo_electronico;
			$usuario->primernombre_c = $d->primernombre_c;
			$usuario->segundonombre_c = $d->segundonombre_c;
			$usuario->primerapellido_c = $d->primerapellido_c;
			$usuario->segundoapellido_c = $d->segundoapellido_c;
			$usuario->tiposdocumentoc_id = $d->tiposdocumentoc_id;
			$usuario->nrodocumento_c = $d->nrodocumento_c;
			$usuario->telefono_c = $d->telefono_c;

			$usuario->save();
		}

		return "MIGRATED";
	}catch(\Exception $e){
		return "ERROR: " . $e->getMessage();
	}
});
*/