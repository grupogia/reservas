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

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/deptos', 'SuiteController@index');

Route::apiResource('/reservaciones', 'ReservationController');

Route::get('/carrito-habitaciones', 'ShoppingCartController@index');
Route::post('/carrito-habitaciones/{product}', 'ShoppingCartController@add');
Route::delete('/carrito-habitaciones/{product}', 'ShoppingCartController@remove');
Route::get('/vaciar-carrito', 'ShoppingCartController@trash');