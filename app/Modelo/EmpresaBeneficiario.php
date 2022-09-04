<?php

namespace App\Modelo;

use Illuminate\Database\Eloquent\Model;

class EmpresaBeneficiario extends Model
{
    protected $table = 'empresa_beneficiarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
