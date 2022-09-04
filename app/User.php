<?php

namespace App;

use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail{
    use Notifiable;
    protected $fillable = [
        'username', 'email', 'password','userlevel',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function usuario() {
        return $this->belongsTo('App\Modelo\Usuario', 'usuario_id');
    }

    public function group(){
        return $this->belongsToMany('App\Groups', 'users_groups', 'user_id', 'group_id');
    }
    public function authorizeRoles($roles){  
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||  abort(401, 'This action is unauthorized.');  
        }
        return $this->hasRole($roles) ||  abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles){
        return null !== $this->group()->whereIn('group_name', $roles)->first();
    }
    
    public function hasRole($role){  
        return null !== $this->group()->where('group_name', $role)->first();
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }
}
