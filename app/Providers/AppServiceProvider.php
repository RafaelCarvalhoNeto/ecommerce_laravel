<?php

namespace App\Providers;

use App\Categoria;
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
            $categorias = Categoria::paginate(5);
            $todasAsCategorias = Categoria::all();
            $view->with([
                'categorias' => $categorias,
                'todasAsCategorias' => $todasAsCategorias
            ]);
        });

    }
}
