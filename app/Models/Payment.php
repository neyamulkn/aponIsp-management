<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paymethod(){
        return $this->belongsTo(PayMethod::class, 'pay_method');
    }
}
