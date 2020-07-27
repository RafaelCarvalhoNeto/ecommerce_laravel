<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function listAllCategorias(){

        if(Auth::check()===true){
            if(Auth::user()->admin==1){
                $categorias = DB::table('categorias');
                $found = $categorias->count();
                $categorias = $categorias->paginate(10);
        
                return view('admin.admCategorias')->with(['categorias'=>$categorias, 'found'=>$found]);
                
            }

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

            return redirect()->route('categorias.listAll')->with('success', 'Categoria criada com sucesso');
        }

    }

    public function update(Request $request, $id){

        $banner = $request->file('banner');

        if(empty($banner)){
            $pathRelative = $request->bannerName;
        } else{
            $banner->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $banner->getClientOriginalName();

            $banner->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $categoria = Categoria::find($id);

        $categoria->banner = $pathRelative;
        $categoria->tipo = $request->inputCategoria;

        $categoria->update();

        if($categoria){    

            return redirect()->route('categorias.listAll')->with('success', 'Categoria editada com sucesso');
        }

    }

    public function deleteCategoria($id){
        $categoria = Categoria::find($id);

        if($categoria->delete()){
            return redirect()->route('categorias.listAll')->with('success', 'Categoria excluída com sucesso');
        }
    }
    public function searchCategoria(Request $request){
        $search = $request->input('search');
        $categorias = Categoria::where('tipo', 'like', '%'.$search.'%');
        $found = $categorias->count();
        $categorias = $categorias->paginate(10);

        return view('admin.admCategorias')->with([
            'search'=>$search,
            'categorias'=>$categorias,
            'found'=>$found
        ]);
    }

}