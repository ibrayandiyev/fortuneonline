<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model{
    protected $table='departamento';
	protected $primaryKey='departamento_id';
	public $timestamps=false;
}
