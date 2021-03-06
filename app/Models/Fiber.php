<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiber extends Model
{
    protected $guarded = [];

    public function cores(){
        return $this->hasMany(Core::class, 'parent_id')->where('type', 'fiber');
    }




}
