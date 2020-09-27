<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'role_id', 'username', 'email', 'mobile', 'password', 'temp_password', 'reset_key','last_login', 'status',  'photo', 'created_at', 'updated_at', 'remember_token'
    ];

    protected $hidden = [
        'password',
    ];

    public function IsAdmin(){
        if ($this->role_id == 1) {
           return true;
        }
        return false;
    }
}
