<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $guarded = [];

    public function spliter_cores(){
        return $this->hasMany(Spliter::class, 'fiber_core_id', 'id');
    }

}
