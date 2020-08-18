<?php

namespace App;

use App\Models\Customers;
use App\Models\Package;
use App\Models\Zone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOnline(){
        return Cache::has('UserOnline-'.$this->id);
    }

    public function customer(){
        return $this->hasOne(Customers::class, 'user_id');
    }

    public function get_subzone(){
        return $this->belongsTo(Zone::class, 'subzone', 'id');
    }

    public function get_zone(){
        return $this->belongsTo(Zone::class, 'zone', 'id');
    }

    public function setup_users(){
        return $this->hasMany(Customers::class, 'setup_by');
    }

}
