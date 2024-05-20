<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/order', 'App\Http\Controllers\OrderController@index')->name('order.index');
Route::get('/order/data', 'App\Http\Controllers\OrderController@data')->name('order.data');
Route::get('/order/menu', 'App\Http\Controllers\OrderController@menu')->name('order.menu');
Route::get('/order/menuPizza', 'App\Http\Controllers\OrderController@menuPizza')->name('order.menuPizza');
Route::post('/client/create', 'App\Http\Controllers\ClientController@create')->name('client.create');
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');
Route::post('/cart/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/addPizza', 'App\Http\Controllers\CartController@addPizza')->name('cart.addPizza');
Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name('cart.purchase');

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
Route::get('/admin/create', 'App\Http\Controllers\AdminController@create')->name('admin.create');
Route::post('/admin/store', 'App\Http\Controllers\AdminController@store')->name('admin.store');
Route::get('/admin/edit/{id}', 'App\Http\Controllers\AdminController@edit')->name('admin.edit');
Route::post('/admin/update/{id}', 'App\Http\Controllers\AdminController@update')->name('admin.update');
Route::get('/admin/delete/{id}', 'App\Http\Controllers\AdminController@delete')->name('admin.delete');
