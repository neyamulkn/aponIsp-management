<?php

use Illuminate\Support\Facades\Route;

Route::get('vendor/login', 'VendorLoginController@LoginForm')->name('vendorLoginForm');
Route::post('vendor/login', 'VendorLoginController@login')->name('vendorLogin');
Route::get('vvendorendor/register', 'VendorLoginController@RegisterForm')->name('vendorRegisterForm');
Route::post('/register', 'VendorLoginController@register')->name('vendorRegister');
Route::get('vendor/logout', 'VendorLoginController@logout')->name('vendorLogout');


// authenticate routes & check role vendor
route::group(['middleware' => ['auth:vendor']], function(){
	Route::get('vendor/dashboard', 'VendorController@dashboard')->name('vendor.dashboard');
	
});


