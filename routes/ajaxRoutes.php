<?php

use Illuminate\Support\Facades\Route;

Route::get('get/core/{id}', 'AjaxController@get_core')->name('get_core');
Route::get('get/extend/core/{id}', 'AjaxController@get_extend_core')->name('get_extend_core');




