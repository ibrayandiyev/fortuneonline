<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Cuentabancaria extends Model{
    protected $table='cuentabancaria';
	protected $primaryKey='cuentabancaria_id';
	public $timestamps=false;

	public function tipo(){
    	return $this->belongsTo('\App\Modelo\Tipocuenta','tipocuenta_id');
	}
	public function banco(){
    	return $this->belongsTo('\App\Modelo\Banco','banco_id');
	}
	public function moneda(){
    	return $this->belongsTo('\App\Modelo\Moneda','moneda_id');
	}
}
