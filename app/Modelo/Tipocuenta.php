<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Tipocuenta extends Model{
    protected $table='tipocuenta';
	protected $primaryKey='tipocuenta_id';
	public $timestamps=false;
}
