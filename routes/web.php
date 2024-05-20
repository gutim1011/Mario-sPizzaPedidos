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
