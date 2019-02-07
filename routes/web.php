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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('clientes', 'ClientesController')->except(['show']);
    Route::resource('mesas', 'MesasController');
    Route::resource('users', 'UsersController');
    Route::resource('menus', 'MenusController');
    Route::resource('pedidos', 'PedidosController');
    Route::resource('facturas', 'FacturasController');

    Route::get('clients/verify/{dni}', 'ClientesController@dni_verify');
    Route::post('clients/assoc/mesa', 'ClientesController@assoc_client_board')->name('assoc.client');

    Route::get('/charge/menu/{categoria}', 'MenusController@charge_menu');
    Route::post('/categoria/store', 'MenusController@categoria_store')->name('menu.categoria.store');
    Route::post('menus/new_item', 'MenusController@store')->name('menu.item.store');
    Route::post('/save/pedido', 'MenusController@save_pedido');
    Route::get('/verify/client/facturar/{dni}/{mesa}', 'FacturasController@verify_client');
    Route::post('/crear/factura', 'FacturasController@crear')->name('facturas.crear');
});
