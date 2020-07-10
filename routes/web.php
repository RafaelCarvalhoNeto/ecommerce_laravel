<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/politicas', function () {
    return view('politicas');
});
Route::get('/carrinho', function () {
    return view('carrinho');
});


// PAINEL DE ADMINISTRAÇÃO

Route::get('/admin/admCategorias', function () {
    return view('admin.admCategorias');
});

Route::get('/admin/admProdutos', function () {
    return view('admin.admProdutos');
});

Route::get('/admProdutos', 'ProdutosController@index');

Route::post('/admProdutos', 'ProdutosController@create');

// USUARIOS
Route::get('/admin/admUsuarios', 'UsersController@listAllUsers')->name('users.listAll');

// EDITAR USUÁRIOS
Route::get('/admin/editUsuarios/{id}', 'UsersController@editUser');
Route::put('/admin/editUsuarios/{id}', 'UsersController@updateUser');

// CRIAR USUÁRIO
Route::get('/cadastro', 'UsersController@createPage');
Route::post('/cadastro', 'UsersController@createUser');

// DELETE USUÁRIO
Route::delete('/admin/remove/{id}', 'UsersController@deleteUser');

// SEARCH USUÁRIO
Route::get('/admin/admUsuarios/search', 'UsersController@searchUser');

// LISTAR CATEGORIAS
Route::get('/admin/admCategorias', 'CategoriasController@listAllCategorias')->name('categorias.listAll');

// ADICIONAR CATEGORIAS
Route::get('/admin/createCategoria', 'CategoriasController@createPage');
Route::post('/admin/createCategoria', 'CategoriasController@createCategoria');
// Route::put('/admin/admCategorias/{id}', 'CategoriasController@createCategoria');

// SEARCH CATEGORIAS
Route::get('/admin/admCategorias/search', 'CategoriasController@searchCategoria');

// DELETE CATEGORIA
Route::delete('/admin/removeCategoria/{id}', 'CategoriasController@deleteCategoria');

// LISTAR MENSAGENS
Route::get('/admin/admMensagens', 'MessageController@listMessage');

// ENVIAR DE MENSAGEM
Route::get('/contato', 'MessageController@pagContato');
Route::post('/contato', 'MessageController@sendMessage');

// DELETE MENSAGEM
Route::delete('/admin/removeMessage/{id}', 'MessageController@deleteMessage');

// SEARCH MENSAGENS
Route::get('admin/admMensagens/search', 'MessageController@searchMessage');

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

Route::get('/admin', 'AuthController@dashboard')->name('admin');

Route::get('/admin/login', 'AuthController@showLoginForm')->name('admin.login');
Route::post('/admin/login/do', 'AuthController@login')->name('admin.login.do');

Route::post('/admin/logout','AuthController@logout')->name('admin.logout');