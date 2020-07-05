<?php

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

Route::get('/', function () {
    return view('index');
});
Route::get('/institucional', function () {
    return view('institucional');
});
Route::get('/404', function () {
    return view('404');
});
Route::get('/contato', function () {
    return view('contato');
});
Route::get('/politicas', function () {
    return view('politicas');
});
Route::get('/carrinho', function () {
    return view('carrinho');
});
Route::get('/admUsuarios', function () {
    return view('admUsuarios');
});
Route::get('/admProdutos', function () {
    return view('admProdutos');
});
Route::get('/admCategorias', function () {
    return view('admCategorias');
});



// USUARIOS
Route::get('admUsuarios', 'UsersController@listAllUsers')->name('users.listAll');

// EDITAR USUÁRIOS
Route::get('editUsuarios/{id}', 'UsersController@editUser');
Route::put('editUsuarios/{id}', 'UsersController@updateUser');

// CRIAR USUÁRIO
Route::get('cadastro', 'UsersController@createPage');
Route::post('cadastro', 'UsersController@createUser');

// DELETE USUÁRIO
Route::delete('remove/{id}', 'UsersController@deleteUser');