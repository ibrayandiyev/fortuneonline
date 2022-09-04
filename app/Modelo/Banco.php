<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model{
    protected $table='banco';
	protected $primaryKey='banco_id';
	public $timestamps=false;
}