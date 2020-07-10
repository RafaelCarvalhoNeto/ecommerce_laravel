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
Route::get('/admin', 'AuthController@dashboard')->name('admin');

Route::group(['middleware'=> 'admin'], function(){

    Route::group(['middleware'=>'auth:admin'], function(){
        
        Route::get('/admin/home', 'AuthController@showHome')->name('admin.home');
                // PAINEL DE ADMINISTRAÇÃO

        Route::get('/admin/admCategorias', function () {
            return view('admin.admCategorias');
        });

        Route::get('/admProdutos', 'ProdutosController@index');

        Route::post('/admProdutos', 'ProdutosController@create');

        // USUARIOS
        Route::get('/admin/admUsuarios', 'UsersController@listAllUsers')->name('users.listAll');

        // EDITAR USUÁRIOS
        
        
        // DELETE USUÁRIO
        Route::delete('/admin/remove/{id}', 'UsersController@deleteUser');
        
        // SEARCH USUÁRIO
        Route::get('/admin/admUsuarios/search', 'UsersController@searchUser');
        
        // LISTAR MENSAGENS
        Route::get('/admin/admMensagens', 'MessageController@listMessage');
        
        
        // DELETE MENSAGEM
        Route::delete('/admin/removeMessage/{id}', 'MessageController@deleteMessage');
        
        // SEARCH MENSAGENS
        Route::get('admin/admMensagens/search', 'MessageController@searchMessage');
        
        
    });
    Route::post('/admin/logout','AuthController@logout')->name('admin.logout');
    
    Route::get('/admin/login', 'AuthController@showLoginForm')->name('admin.login');
    Route::post('/admin/login/do', 'AuthController@login')->name('admin.login.do');
    
});


Route::get('/admin/cadastroAdms', 'AuthController@createPager');
Route::post('/admin/cadastroAdms', 'AuthController@createUser');



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

// CRIAR USUÁRIO
Route::get('/cadastro', 'UsersController@createPage');
Route::post('/cadastro', 'UsersController@createUser');
// ENVIAR DE MENSAGEM
Route::get('/contato', 'MessageController@pagContato');
Route::post('/contato', 'MessageController@sendMessage');

Route::group(['middleware'=> 'auth:web'], function(){


    Route::get('/admin/editUsuarios/{id}', 'UsersController@editUser');
    Route::put('/admin/editUsuarios/{id}', 'UsersController@updateUser');
});



