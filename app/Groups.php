<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model{
	
    protected $table='groups';
	protected $primaryKey='group_id';
	public $timestamps=false;

    public function group(){
        return $this->belongsToMany('App\User', 'users_groups', 'user_id', 'group_id');
    }

}
