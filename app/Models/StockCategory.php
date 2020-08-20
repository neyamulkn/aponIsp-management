<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    protected $guarded = [];

    public function get_stocks(){
        return $this->hasMany(Stock::class, 'category_id');
    }

    public function getUsedStocks(){
        return $this->hasMany(Stock::class, 'category_id')->where('status', 'warranty');
    }
}
