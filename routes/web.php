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

// Usuarios
Route::get('/usuarios', 'UserController@index')->name('users');

Route::get('/usuarios/create', 'UserController@create')->name('users.create');
Route::post('/usuarios', 'UserController@store')->name('users.store');

Route::get('/usuarios/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/usuarios/{user}', 'UserController@update')->name('users.update');

Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');

Route::post('/assign-role/{user}', 'UserController@assignRoleUser')->name('assign.role.user');
Route::post('/remove-role/{user}', 'UserController@removeRoleUser')->name('remove.role.user');

// Habitaciones
Route::get('/habitaciones', 'SuiteController@suitesView')->name('suites');

Route::get('/escritorio', 'DashboardController@index')->name('dashboard');

Route::get('/deptos', 'SuiteController@getArraySuites');

Route::get('/eventos', 'LogController@logView')->name('log');

Route::resource('suites', 'SuiteController');

// Reservaciones
Route::post('/calcular-precio', 'ReservationController@calculatePrice');
Route::apiResource('reservaciones', 'ReservationController');

Route::get('/imprimir-reservacion/{reservacion}', 'PrintReservationController');

// Carrito
Route::get('/carrito-habitaciones', 'ShoppingCartController@index');
Route::post('/carrito-habitaciones/{product}', 'ShoppingCartController@add');
Route::delete('/carrito-habitaciones/{product}', 'ShoppingCartController@remove');
Route::get('/vaciar-carrito', 'ShoppingCartController@trash');

// Roles
Route::get('/roles', 'RoleController@index')->name('roles');