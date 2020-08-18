<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setupBy(){
        return $this->belongsTo(User::class, 'setup_by');
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function box(){
        return $this->belongsTo(Box::class);
    }

    public function cable(){
        return $this->belongsTo(Cable::class);
    }


}
