<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    public function listAllCategorias(){

        if(Auth::check()===true){
            $categorias = Categoria::paginate(10);
            return view('admin.admCategorias')->with('categorias', $categorias);

        }
        return redirect()->route('admin.login');
    }

    public function createCategoria(Request $request){

        $categoria = new Categoria;

        $categoria->categoria = $request->inputCategoria;

        $categoria->save();

        if($categoria){             
            $categorias = Categoria::paginate(10);             
            
            return view('admin.admCategorias')->with([
                'categorias'=> $categorias,
                'success'=>'Categoria adicionada com sucesso'
                ]);
        }

    }

    public function deleteCategoria($id){
        $categoria = Categoria::find($id);

        if($categoria->delete()){
            $categorias = Categoria::paginate(10);

            return view('admin.admCategorias')->with([
                'categorias'=>$categorias,
                'success'=> 'Categoria excluída com sucesso'
            ]);
        }
    }
    public function searchCategoria(Request $request){
        $search = $request->input('search');
        $categorias = Categoria::where('categoria', 'like', '%'.$search.'%')->paginate(10);

        return view('admin.admCategorias')->with([
            'search'=>$search,
            'categorias'=>$categorias
        ]);
    }

}