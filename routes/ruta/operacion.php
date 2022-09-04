<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth','usuario','verified','empresa'])->group(function () {
	Route::post('/soperacion', 'Control\COperacion@soperacion')->name('soperacion');
});

Route::middleware(['auth','admin','verified','empresa'])->group(function () {
	Route::get('/uoperacion/{i}', 'Control\COperacion@uoperacion')->name('uoperacion');
	Route::get('/doperacion/{i}', 'Control\COperacion@doperacion')->name('doperacion');
});

Route::middleware(['auth','verified','empresa'])->group(function () {
	Route::get('/foperacion/{i}', 'Control\COperacion@foperacion')->name('foperacion');
});

Route::middleware(['auth','verified','admin'])->group(function () {
	Route::post('/svoucher', 'Control\COperacion@svoucher')->name('svoucher');
});

Route::middleware(['auth','verified','admin'])->group(function () {
	Route::get('/config/dev/activar-operaciones', function(){
		$enabled_operations = DB::table('configuration')->where('config_name', 'enabled_operations')->first();

		if (!$enabled_operations) {
			$enabled_operations = DB::table('configuration')->insert([
				'config_name' => 'enabled_operations',
				'config_value' => 1,
			]);
		}
		else {
			DB::table('configuration')->where('config_name', 'enabled_operations')->update(['config_value' => 1]);
		}

		return redirect()->route('home');
	})->name('activar-operaciones');
	
	Route::get('/config/dev/desactivar-operaciones', function(){
		$enabled_operations = DB::table('configuration')->where('config_name', 'enabled_operations')->first();

		if (!$enabled_operations) {
			$enabled_operations = DB::table('configuration')->insert([
				'config_name' => 'enabled_operations',
				'config_value' => 0,
			]);
		}
		else {
			DB::table('configuration')->where('config_name', 'enabled_operations')->update(['config_value' => 0]);
		}

		return redirect()->route('home');
	})->name('desactivar-operaciones');

	Route::get('/iniciar-operacion-manual', 'Control\COperacion@iniciarOperacionManual')->name('iniciar-operacion-manual');
	Route::post('/guardar-operacion-manual', 'Control\COperacion@guardarOperacionManual')->name('guardar-operacion-manual');
});
?>