<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StockPayment extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function get_user(){
        return $this->belongsTo(User::class, 'payment_by')->select('name');
    }

    public function get_stockPayment(){
        return $this->hasMany(Stock::class, 'invoice', 'invoice');
    }

}
