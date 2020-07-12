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

Route::get('/politicas', function () {
    return view('politicas');
});
Route::get('/carrinho', function () {
    return view('carrinho');
});


// PAINEL DE ADMINISTRAÇÃO

Route::get('/painelAdm', function(){
    return view('painelAdm');
});

Route::get('/admCategorias', function () {
    return view('admCategorias');
});

// PRODUTOS
Route::get('/admin/admProdutos/novo', 'ProdutosController@index');

Route::post('/admin/admProdutos/novo', 'ProdutosController@create');

Route::post('/admin/update/{id}', 'ProdutosController@edit');

Route::delete('/admin/admProdutos/{id}', 'CardsController@delete');

Route::post('/admin/admProdutos/novo', 'CardsController@search');

// USUARIOS
Route::get('/admUsuarios', 'UsersController@listAllUsers')->name('users.listAll');

// EDITAR USUÁRIOS
Route::get('/editUsuarios/{id}', 'UsersController@editUser');
Route::put('/editUsuarios/{id}', 'UsersController@updateUser');

// CRIAR USUÁRIO
Route::get('/cadastro', 'UsersController@createPage');
Route::post('/cadastro', 'UsersController@createUser');

// DELETE USUÁRIO
Route::delete('/remove/{id}', 'UsersController@deleteUser');

// SEARCH USUÁRIO
Route::get('/admUsuarios/search', 'UsersController@searchUser');

// LISTAR MENSAGENS
Route::get('/admMensagens', 'MessageController@listMessage');

// ENVIAR DE MENSAGEM
Route::get('/contato', 'MessageController@pagContato');
Route::post('/contato', 'MessageController@sendMessage');

// DELETE MENSAGEM
Route::delete('/removeMessage/{id}', 'MessageController@deleteMessage');


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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
