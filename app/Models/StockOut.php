<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $guarded = [];

    public function get_user(){
        return $this->belongsTo(User::class, 'stock_out_by');
    }

    public function get_box(){
        return $this->belongsTo(Box::class, 'stock_out_by');
    }
    public function supply_by(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
