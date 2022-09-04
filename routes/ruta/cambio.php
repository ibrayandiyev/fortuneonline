<?php 

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','empresa'])->group(function () {
	Route::get('/ftipocambio', 'Control\CTipocambio@ftipocambio')->name('ftipocambio');
	Route::get('/ltipocambio', 'Control\CTipocambio@ltipocambio')->name('ltipocambio');
});
Route::middleware(['auth','admin','verified','empresa'])->group(function (){
	Route::post('/stipocambio', 'Control\CTipocambio@stipocambio')->name('stipocambio');
});

Route::post('/update-cuantoestaeldolar', 'Control\CTipocambio@updateCuantoestaeldolar')->name('updateCuantoestaeldolar');
?>