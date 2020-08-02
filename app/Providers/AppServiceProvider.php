<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use App\Pedido;
use Illuminate\Support\Facades\View;
use App\Cart;
use Session;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $categoriasNav = Categoria::paginate(5);
            $todasAsCategorias = Categoria::all();
            
            if(Auth::check()===true){
                $itensCarro = Pedido::where([
                    'status'=>'RE',
                    'user_id'=>Auth::id()
                ])->get();
                !empty($itensCarro[0]->id)?
                $itensCarro = $itensCarro[0]->pedido_produtos->count():
                $itensCarro = 0;
            } else {
                $itensCarro = 0;
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $itensCarro = $cart->totalQtd;
            }


            $view->with([
                'categoriasNav' => $categoriasNav,
                'todasAsCategorias' => $todasAsCategorias,
                'itensCarro'=> $itensCarro
            ]);
        });

    }
}
