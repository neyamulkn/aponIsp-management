<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtendCore extends Model
{
    protected $guarded = [];

    public function spliter(){
        return $this->belongsTo(Spliter::class, 'spliter_id');
    }
}
