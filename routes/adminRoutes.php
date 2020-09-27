<?php

Route::get('/login', 'AdminLoginController@LoginForm')->name('adminLoginForm');
Route::post('/login', 'AdminLoginController@login')->name('adminLogin');
Route::get('/register', 'AdminLoginController@RegisterForm')->name('adminRegisterForm');
Route::post('/register', 'AdminLoginController@register')->name('adminRegister');
Route::get('/logout', 'AdminLoginController@logout')->name('adminLogout');

Route::group(['middleware' => ['admin', 'auth:vendor']], function(){
	Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
	Route::get('zone/create', 'ZoneController@index')->name('zone.create');
	Route::post('zone/store', 'ZoneController@store')->name('zone.store');
	Route::get('zone/list', 'ZoneController@index')->name('zone.list');
	Route::get('zone/edit/{id}', 'ZoneController@edit')->name('zone.edit');
	Route::post('zone/update', 'ZoneController@update')->name('zone.update');
	Route::get('zone/delete/{id}', 'ZoneController@delete')->name('zone.delete');

	// sub zone routes
	Route::get('subzone/create', 'ZoneController@subzone_index')->name('subzone.create');
	Route::post('subzone/store', 'ZoneController@subzone_store')->name('subzone.store');
	Route::get('subzone/list', 'ZoneController@subzone_index')->name('subzone.list');
	Route::get('subzone/edit/{id}', 'ZoneController@subzone_edit')->name('subzone.edit');
	Route::post('subzone/update', 'ZoneController@subzone_update')->name('subzone.update');
	Route::get('subzone/delete/{id}', 'ZoneController@subzone_delete')->name('subzone.delete');

	Route::get('get/subzone/{id}', 'ZoneController@get_subzone')->name('get_subzone');


	// district routes
	Route::get('district/create', 'DistrictController@index')->name('district.create');
	Route::post('district/store', 'DistrictController@store')->name('district.store');
	Route::get('district/list', 'DistrictController@index')->name('district.list');
	Route::get('district/edit/{id}', 'DistrictController@edit')->name('district.edit');
	Route::post('district/update', 'DistrictController@update')->name('district.update');
	Route::get('district/delete/{id}', 'DistrictController@delete')->name('district.delete');

	// upzilla routes
	Route::get('upzilla/create', 'UpzillaController@index')->name('upzilla.create');
	Route::post('upzilla/store', 'UpzillaController@store')->name('upzilla.store');
	Route::get('upzilla/list', 'UpzillaController@index')->name('upzilla.list');
	Route::get('upzilla/edit/{id}', 'UpzillaController@edit')->name('upzilla.edit');
	Route::post('upzilla/update', 'UpzillaController@update')->name('upzilla.update');
	Route::get('upzilla/delete/{id}', 'UpzillaController@delete')->name('upzilla.delete');

	Route::get('get/upzilla/{id}', 'UpzillaController@get_upzilla')->name('get_upzilla');

	// box routes
	Route::get('box/create', 'BoxController@index')->name('box.create');
	Route::post('box/store', 'BoxController@store')->name('box.store');
	Route::get('box/list', 'BoxController@index')->name('box.list');
	Route::get('box/edit/{id}', 'BoxController@edit')->name('box.edit');
	Route::post('box/update', 'BoxController@update')->name('box.update');
	Route::get('box/delete/{id}', 'BoxController@delete')->name('box.delete');

		// cable routes
	Route::get('cable/create', 'CableController@index')->name('cable.create');
	Route::post('cable/store', 'CableController@store')->name('cable.store');
	Route::get('cable/list', 'CableController@index')->name('cable.list');
	Route::get('cable/edit/{id}', 'CableController@edit')->name('cable.edit');
	Route::post('cable/update', 'CableController@update')->name('cable.update');
	Route::get('cable/delete/{id}', 'CableController@delete')->name('cable.delete');

	Route::get('paymentmethod/create', 'PayMethodController@index')->name('paymentmethod.create');
	Route::post('paymentmethod/store', 'PayMethodController@store')->name('paymentmethod.store');
	Route::get('paymentmethod/list', 'PayMethodController@index')->name('paymentmethod.list');
	Route::get('paymentmethod/edit/{id}', 'PayMethodController@edit')->name('paymentmethod.edit');
	Route::post('paymentmethod/update', 'PayMethodController@update')->name('paymentmethod.update');
	Route::get('paymentmethod/delete/{id}', 'PayMethodController@delete')->name('paymentmethod.delete');



	// package routes
	Route::get('package/create', 'PackageController@create')->name('package.create');
	Route::post('package/store', 'PackageController@store')->name('package.store');
	Route::get('package/list', 'PackageController@index')->name('package.list');
	Route::get('package/{id}/edit', 'PackageController@edit')->name('package.edit');
	Route::post('package/update/{id}', 'PackageController@update')->name('package.update');
	Route::get('package/delete/{id}', 'PackageController@delete')->name('package.delete');

	Route::get('package/details/{id}', 'PackageController@package_details')->name('package.details');


	// user routes
	Route::get('user/create', 'UserController@create')->name('user.create');
	Route::post('user/store', 'UserController@store')->name('user.store');
	Route::get('user/list', 'UserController@index')->name('user.list');
	Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
	Route::post('user/update/{id}', 'UserController@update')->name('user.update');
	Route::get('user/delete/{id}', 'UserController@delete')->name('user.delete');

	Route::get('user/profile/{username}', 'UserController@user_profile')->name('user.profile');
	Route::get('user/active', 'UserController@active_user')->name('user.active');
	Route::get('user/inactive', 'UserController@inactive_user')->name('user.inactive');
	Route::get('user/block', 'UserController@block_user')->name('user.block');
	Route::get('user/download', 'UserController@download_user')->name('user.download');

	// designation routes
	Route::get('designation/create', 'DesignationController@create')->name('designation.create');
	Route::post('designation/store', 'DesignationController@store')->name('designation.store');
	Route::get('designation/list', 'DesignationController@index')->name('designation.list');
	Route::get('designation/{id}/edit', 'DesignationController@edit')->name('designation.edit');
	Route::post('designation/update', 'DesignationController@update')->name('designation.update');
	Route::get('designation/delete/{id}', 'DesignationController@delete')->name('designation.delete');

	// staff routes
	Route::get('staff/create', 'AdminStaffController@create')->name('staff.create');
	Route::post('staff/store', 'AdminStaffController@store')->name('staff.store');
	Route::get('staff/list', 'AdminStaffController@index')->name('staff.list');
	Route::get('staff/{id}/edit', 'AdminStaffController@edit')->name('staff.edit');
	Route::post('staff/update', 'AdminStaffController@update')->name('staff.update');
	Route::get('staff/delete/{id}', 'AdminStaffController@delete')->name('staff.delete');

	// stock category routes
	Route::get('stock/category', 'StockController@stockCategory_index')->name('stockCategory');
	Route::post('stock/category/store', 'StockController@stockCategory_store')->name('stockCategory.store');

	Route::get('stock/category/{id}/edit', 'StockController@stockCategory_edit')->name('stockCategory.edit');
	Route::post('stock/category/update', 'StockController@stockCategory_update')->name('stockCategory.update');
	Route::get('stock/category/delete/{id}', 'StockController@stockCategory_delete')->name('stockCategory.delete');

	// stock routes
	Route::get('stock/list', 'StockController@index')->name('stock');
	Route::get('stock/create', 'StockController@create')->name('stock.create');
	Route::post('stock/store', 'StockController@store')->name('stock.store');
	Route::get('stock/{id}/edit', 'StockController@edit')->name('stock.edit');
	Route::post('stock/update', 'StockController@update')->name('stock.update');
	Route::get('stock/delete/{id}', 'StockController@delete')->name('stock.delete');

	// brand routes
	Route::get('stock/brand', 'BrandController@index')->name('brand');
	Route::post('stock/brand/store', 'BrandController@store')->name('brand.store');
	Route::get('stock/brand/{id}/edit', 'BrandController@edit')->name('brand.edit');
	Route::post('stock/brand/update', 'BrandController@update')->name('brand.update');
	Route::get('stock/brand/delete/{id}', 'BrandController@delete')->name('brand.delete');

	// stock routes
	Route::get('stock/shop', 'StockController@stockShop_index')->name('stockShop');
	Route::post('stock/shop/store', 'StockController@stockShop_store')->name('stockShop.store');
	Route::get('stock/shop/{id}/edit', 'StockController@stockShop_edit')->name('stockShop.edit');
	Route::post('stock/shop/update', 'StockController@stockShop_update')->name('stockShop.update');
	Route::get('stock/shop/delete/{id}', 'StockController@stockShop_delete')->name('stockShop.delete');
	//get shop due for payment
	Route::get('stock/shop/getdue/{shop_id}', 'StockController@get_duePayment')->name('stock.duePayment');
	//shop payment
	Route::post('stock/shop/payment', 'StockController@stockPayment')->name('stock.payment');
	//stock details by shop
	Route::get('stock/shop/{id}/{name?}', 'StockController@stockByShop')->name('stock.ByShop');
	//stock details by category
	Route::get('stock/category/{cat_id}/{name?}', 'StockController@stockByCategory')->name('stock.ByCategory');
	//used stock count by category
	Route::get('stock/used/list', 'StockController@usedStock')->name('stock.used');
	//used stock by category
	Route::get('stock/used/list/{cat_id}/{name?}', 'StockController@stockUsedByCategory')->name('stock.usedByCategory');
	//send used stock
	Route::get('stock/send/type/{id}', 'StockController@stockSendType')->name('stock.sendType');
	Route::post('stock/send', 'StockController@stockSend')->name('stock.send');

	//stock details by invoice
	Route::get('stock/invoice/{id}', 'StockController@stockByinvoice')->name('stock.Byinvoice');

	Route::get('stock/payment/history/{id}/{name?}', 'StockController@stockPaymentHistory')->name('stock.paymentHistory');

	Route::get('stock/out/type', 'StockController@stockOutType')->name('stock.outType');
	Route::post('stock/out', 'StockController@stockOut')->name('stock.out');
	Route::get('stock/out/details/{id}/{name?}', 'StockController@stockOutDetails')->name('stock.outDetails');


	// role routes
	Route::get('role/create', 'RoleController@create')->name('role.create');
	Route::post('role/store', 'RoleController@store')->name('role.store');
	Route::get('role/list', 'RoleController@index')->name('role.list');
	Route::get('role/{id}/edit', 'RoleController@edit')->name('role.edit');
	Route::post('role/update', 'RoleController@update')->name('role.update');
	Route::get('role/delete/{id}', 'RoleController@delete')->name('role.delete');

	// fiber routes
	Route::get('fiber', 'FiberController@index')->name('fiber');
	Route::post('fiber/store', 'FiberController@store')->name('fiber.store');
	Route::get('fiber/{id}/edit', 'FiberController@edit')->name('fiber.edit');
	Route::post('fiber/update', 'FiberController@update')->name('fiber.update');
	Route::get('fiber/delete/{id}', 'FiberController@delete')->name('fiber.delete');
	//show all core
	Route::get('fiber/view/allcore/{id}', 'FiberController@showFiberCore')->name('fiber.showAllCore');
	Route::get('fiber/get/spliter/list/{core_no}', 'FiberController@getSpliter')->name('fiber.getAllSpliter');
	Route::post('fiber/extend/core', 'FiberController@extendCore')->name('fiber.extendCore');


	// spliter routes
	Route::get('spliter', 'SpliterController@index')->name('spliter');
	Route::post('spliter/store', 'SpliterController@store')->name('spliter.store');
	Route::get('spliter/{id}/edit', 'SpliterController@edit')->name('spliter.edit');
	Route::post('spliter/update', 'SpliterController@update')->name('spliter.update');
	Route::get('spliter/delete/{id}', 'SpliterController@delete')->name('spliter.delete');
	//show all core
	Route::get('spliter/view/allcore/{id}', 'SpliterController@showSpliterCore')->name('spliter.showAllCore');
	Route::get('spliter/get/spliter/list/{core_no}', 'SpliterController@getSpliter')->name('spliter.getAllSpliter');
	Route::post('spliter/extend/core', 'SpliterController@extendCore')->name('spliter.extendCore');

	// tj routes
	Route::get('tj', 'TjController@index')->name('tj');
	Route::post('tj/store', 'TjController@store')->name('tj.store');
	Route::get('tj/{id}/edit', 'TjController@edit')->name('tj.edit');
	Route::post('tj/update', 'TjController@update')->name('tj.update');
	Route::get('tj/delete/{id}', 'TjController@delete')->name('tj.delete');

	Route::get('tj/connection/{slug}', 'TjConnectionController@tjConnection')->name('tj.connection');
	
	Route::post('tj/connection/{slug}', 'TjConnectionController@tjConnectionStore')->name('tj.connectionStore');
	Route::get('tj/connection/delete/{id}', 'TjConnectionController@delete')->name('tj.connectionDelete');





});



?>
