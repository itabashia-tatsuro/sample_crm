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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::post('/customers/search', 'CustomerController@index')->name('search.customers');
Route::get('/customer/{customer}', 'CustomerController@show')->name('customer.detail');

Route::resource('items', 'ItemController');
Route::post('/items/search', 'ItemController@index')->name('search.items');