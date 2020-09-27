<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $guarded = [];

    public function extend_core(){
        return $this->belongsTo(Spliter::class, 'id', 'extend_core_id');
    }

}
