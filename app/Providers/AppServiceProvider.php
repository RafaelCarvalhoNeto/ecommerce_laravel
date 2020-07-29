<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use App\Pedido;
use Illuminate\Support\Facades\View;

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
                $itensCarro = $itensCarro[0]->pedido_produtos->count();
            } else {
                $itensCarro = 0;

            }
            $view->with([
                'categoriasNav' => $categoriasNav,
                'todasAsCategorias' => $todasAsCategorias,
                'itensCarro'=> $itensCarro
            ]);
        });

    }
}
