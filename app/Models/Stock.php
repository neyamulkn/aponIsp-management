<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    public function get_category(){
    	return $this->belongsTo(StockCategory::class, 'category_id');
    }

    public function get_brand(){
    	return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function get_shop(){
    	return $this->belongsTo(StockShop::class, 'shop_id');
    }
}
