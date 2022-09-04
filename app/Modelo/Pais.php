<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model{
    protected $table='pais';
	protected $primaryKey='pais_id';
	public $timestamps=false;
}
