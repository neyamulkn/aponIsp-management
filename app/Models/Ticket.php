<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected  $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function single_conversation(){
        return $this->hasOne(TicketConversation::class)->orderBy('id', 'desc');
    }    

    public function ticket_conversation(){
        return $this->hasMany(TicketConversation::class);
    }

}
