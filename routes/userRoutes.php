<?php

use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'User'], function(){

});


