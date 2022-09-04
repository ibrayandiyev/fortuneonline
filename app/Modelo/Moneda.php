<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model{
    protected $table='moneda';
	protected $primaryKey='moneda_id';
	public $timestamps=false;
}
