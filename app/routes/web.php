<?php

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

use App\Http\Controllers\CustomerController;

Auth::routes();

Route::get('/output', 'ItemController@export')->name('excel.download');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::get('/customers/search', 'CustomerController@index')->name('search.customers');
Route::get('/customer/{customer}', 'CustomerController@show')->name('customer.detail');

Route::get('/items/search', 'ItemController@index')->name('search.items');
Route::resource('items', 'ItemController');

Route::get('/orders/search', 'orderController@index')->name('search.orders');
Route::resource('orders', 'OrderController');

Route::resource('analysis', 'AnalysisController')->except('edit', 'destroy');