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

        $banner = $request->file('banner');

        if(empty($banner)){
            $pathRelative = null;
        } else{
            $banner->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $banner->getClientOriginalName();

            $banner->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $categoria = new Categoria;

        $categoria->banner = $pathRelative;
        $categoria->tipo = $request->inputCategoria;

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
        $categorias = Categoria::where('tipo', 'like', '%'.$search.'%')->paginate(10);

        return view('admin.admCategorias')->with([
            'search'=>$search,
            'categorias'=>$categorias
        ]);
    }

}