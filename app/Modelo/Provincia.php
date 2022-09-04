<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model{
    protected $table='provincia';
	protected $primaryKey='provincia_id';
	public $timestamps=false;
}
