<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth', 'admin']], function(){
	Route::get('/', 'DashboardController@dashboard')->name('dashboard');
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

	//Ticket routes
	Route::get('ticket/create', 'TicketController@create')->name('ticket.create');
	Route::post('ticket/store', 'TicketController@store')->name('ticket.store');
	Route::get('ticket/list', 'TicketController@index')->name('ticket.list');
	
	Route::get('ticket/conversation/{slug?}', 'TicketConversationController@create')->name('ticket.conversation');
	Route::post('ticket/conversation/store', 'TicketConversationController@store')->name('ticket.conversation.store');


	// invoice routes
	Route::get('invoice/create', 'InvoiceController@create')->name('invoice.create');
	Route::post('invoice/store', 'InvoiceController@store')->name('invoice.store');
	Route::get('invoice/list', 'InvoiceController@index')->name('invoice.list');
	Route::get('invoice/edit/{id}', 'InvoiceController@edit')->name('invoice.edit');
	Route::post('invoice/update', 'InvoiceController@update')->name('invoice.update');
	Route::get('invoice/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');

	Route::get('invoice/view/{invoice_id}', 'InvoiceController@invoice')->name('invoice.view');


	// paymentmethod routes
	Route::get('payment/dashboard', 'PaymentController@dashboard')->name('payment.dashboard');
	


	Route::get('payment/list', 'PaymentController@list')->name('payment.list');
	Route::post('payment/store', 'PaymentController@store')->name('payment.store');

});

Auth::routes();

