<?php
Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
Route::group(['middleware' => ['auth']], function(){

	

});



