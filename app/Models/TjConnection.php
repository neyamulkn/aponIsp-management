<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TjConnection extends Model
{
    protected $guarded = [];

    public function get_fiber_start(){
        return $this->belongsTo(Fiber::class, 'fiber_start');
    }

    public function connect_core_start(){
        return $this->belongsTo(Core::class, 'core_start');
    }
    public function connect_extend_core_start(){
        return $this->belongsTo(Core::class, 'extend_spliter_core_start');
    }

    public function connect_core_out(){
        return $this->belongsTo(Core::class, 'core_out');
    }
    public function connect_extend_core_out(){
        return $this->belongsTo(Core::class, 'extend_spliter_core_out');
    }

    public function get_fiber_out(){
        return $this->hasOne(Fiber::class,'id', 'fiber_out');
    }
    public function get_spliter_start(){
        return $this->hasOne(Spliter::class, 'id', 'extend_spliter_start');
    }
    public function get_spliter_out(){
        return $this->hasOne(Spliter::class, 'id', 'extend_spliter_out');
    }
}
