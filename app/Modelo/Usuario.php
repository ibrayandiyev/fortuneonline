<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{
    protected $table='usuario';
	protected $primaryKey='usuario_id';
	public $timestamps=false;

	public function departamento(){
        return $this->belongsTo('App\Modelo\Ubigeo', 'departamento_id','dDepartamento');
    }
    public function provincia(){
        return $this->belongsTo('App\Modelo\Ubigeo', 'provincia_id','codProvincia');
    }
    public function distrito(){
        return $this->belongsTo('App\Modelo\Ubigeo', 'distrito_id','codDistrito');
    }
    public function tiposdocumento(){
        return $this->belongsTo('App\Modelo\Tiposdocumento', 'tiposdocumento_id');
    }
    public function pais(){
        return $this->belongsTo('App\Modelo\Pais', 'pais_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'usuario_id','usuario_id');
    }
    public function paisdireccion(){
        return $this->belongsTo('App\Modelo\Pais', 'paisdireccion_id', 'pais_id');
    }
    public function ocupacion(){
        return $this->belongsTo('App\Modelo\Ocupacion', 'ocupacion_id');
    }
    public function ocupacion_c(){
        return $this->belongsTo('App\Modelo\Ocupacion', 'ocupacion_c_id');
    }
    public function cuenta(){
        return $this->hasMany('App\Modelo\Cuentabancaria', 'usuario_id');
    }    
    public function beneficiarios(){
        return $this->hasMany('App\Modelo\EmpresaBeneficiario', 'usuario_id');
    }    
}
