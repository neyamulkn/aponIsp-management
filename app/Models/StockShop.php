<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockShop extends Model
{
    protected $guarded = [];

    public function get_stock(){
        return $this->hasMany(Stock::class, 'shop_id', 'id');
    }
    public function get_payment(){
        return $this->hasMany(StockPayment::class, 'shop_id', 'id');
    }
}
