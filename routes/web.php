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

Route::get('/index', function () {
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
Route::get('admUsuarios', function () {
    return view('admUsuarios');
});
Route::get('admProdutos', function () {
    return view('admProdutos');
});
Route::get('admCategorias', function () {
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

// SEARCH USUÁRIO
Route::get('admUsuarios/search', 'UsersController@searchUser');

Route::get('admMensagens', function () {
    return view('admMensagens');
});

Route::get('/detalheProduto', function () {
    return view('detalheProduto');
});
Route::get('/ofertas', function () {
    return view('ofertas');
});
Route::get('/livros', function () {
    return view('livros');
});
Route::get('/eletronicos', function () {
    return view('eletronicos');
});
Route::get('/bolsas', function () {
    return view('bolsas');
});
Route::get('/busca', function () {
    return view('busca');
});
Route::get('/finalizarCompra', function () {
    return view('finalizarCompra');
});
Route::get('/historicoPedidos', function () {
    return view('historicoPedidos');
});
