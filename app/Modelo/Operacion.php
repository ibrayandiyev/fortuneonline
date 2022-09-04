<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model{
    protected $table='operacion';
	protected $primaryKey='operacion_id';

	public function cuentabancariae(){
        return $this->hasMany('App\Modelo\Cuentabancaria', 'cuentabancaria_id' , 'cuentabancariae_id');
    }
    public function cuentabancariad(){
        return $this->hasMany('App\Modelo\Cuentabancaria', 'cuentabancaria_id', 'cuentabancariad_id');
    }
    public function cuentabancariat(){
        return $this->hasMany('App\Modelo\Cuentabancaria', 'cuentabancaria_id', 'cuentabancariat_id');
    }
	public function monedae(){
        return $this->belongsTo('App\Modelo\Moneda', 'moneda_id');
    }
    public function monedad(){
        return $this->belongsTo('App\Modelo\Moneda', 'tmoneda_id', 'moneda_id');
    }
    public function usuario(){
        return $this->belongsTo('App\Modelo\Usuario', 'usuario_id');
    }
    public function origen_fondo(){
        return $this->belongsTo('App\Modelo\OrigenFondo', 'origen_fondo_id');
    }
}
