<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upzilla extends Model
{
    protected $guarded = [];

    public function district(){
        return $this->belongsTo(District::class);
    }
}
