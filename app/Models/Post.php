<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Events\PostDeteted;
use App\Events\PostUpdated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
        'deleted' => PostDeteted::class,
    ];

}
