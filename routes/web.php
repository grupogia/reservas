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

Route::get('/usuarios/{user}', 'UserController@show')->name('users.show');
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

Route::post('/asignar-tarifa/{suite}', 'SuiteController@assignRate')->name('assign.rate');
Route::delete('/remover-tarifa/{rate}', 'SuiteController@removeRate')->name('remove.rate');

Route::resource('suites', 'SuiteController');

// Reservaciones
Route::post('/calcular-precio', 'ReservationController@calculatePrice')->name('calculate-price');
Route::get('/cambiar-metodo-pago/{reservation}', 'ChangePaymentController@index')->name('change.payment');
Route::put('/cambiar-metodo-pago/{reservation}', 'ChangePaymentController@update')->name('change.payment.update');
Route::apiResource('reservaciones', 'ReservationController');

Route::get('/imprimir-reservacion/{reservacion}', 'PrintReservationController');

// Carrito
Route::get('/carrito-habitaciones', 'ShoppingCartController@index');
Route::post('/carrito-habitaciones/{product}', 'ShoppingCartController@add');
Route::delete('/carrito-habitaciones/{product}', 'ShoppingCartController@remove');
Route::get('/vaciar-carrito', 'ShoppingCartController@trash');

// Permisos
Route::get('/permisos', 'PermissionController@index')->name('permissions');
Route::get('/permisos/create', 'PermissionController@create')->name('permissions.create');
Route::post('/permisos', 'PermissionController@store')->name('permissions.store');
Route::delete('/permisos/{permission}', 'PermissionController@destroy')->name('permissions.destroy');

// Roles
Route::get('/roles', 'RoleController@index')->name('roles');
Route::get('/roles/create', 'RoleController@create')->name('roles.create');
Route::post('/roles', 'RoleController@store')->name('roles.store');
Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
Route::put('/roles/{role}', 'RoleController@update')->name('roles.update');
Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy');

Route::post('/roles/asignar-permiso/{role}', 'RoleController@assignPermission')->name('roles.assign.permission');

// Perfil
Route::get('/perfil', 'Auth\ProfileController@index')->name('profile');
Route::put('/perfil/actualizar', 'Auth\ProfileController@update')->name('profile.update');
Route::get('/mis-reservaciones', 'Auth\ProfileController@reservations')->name('auth.reservations');