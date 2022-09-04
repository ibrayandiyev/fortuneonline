<?php 

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','empresa'])->group(function () {
	Route::post('/scuentasbancaria', 'Control\CCuentabancaria@scuentasbancaria')->name('scuentasbancaria');
	Route::post('/ucuentasbancaria/{i}', 'Control\CCuentabancaria@ucuentasbancaria')->name('ucuentasbancaria');
	Route::get('/lcuentasbancaria', 'Control\CCuentabancaria@lcuentasbancaria')->name('lcuentasbancaria');
	Route::get('/fcuentasbancaria/{i}', 'Control\CCuentabancaria@fcuentasbancaria')->name('fcuentasbancaria');
	Route::get('/dcuentasbancaria/{i}', 'Control\CCuentabancaria@dcuentasbancaria')->name('dcuentasbancaria');
});

Route::post('/save-account-operacion-manual', 'Control\CCuentabancaria@saveAccountOperacionManual')->name('save-account-operacion-manual');
Route::get('/get-accounts-operacion-manual/{userId}', 'Control\CCuentabancaria@getAccountsOperacionManual')->name('get-accounts-operacion-manual');
?>