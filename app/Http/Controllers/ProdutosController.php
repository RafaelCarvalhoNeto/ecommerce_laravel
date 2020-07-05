<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutosController extends Controller
{
    public function index() {

        $produtos = Produto::paginate(10);

        if($produtos){
            return view('admProdutos')->with('produtos', $produtos);
    }
}

    public function create(Request $request) {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:50'
        ]);
        $image = $request->file('image');
        
        if(empty($image)){
            $pathRelative = null;
        } else{
            $image->storePublicly('img');
            
            $absolutepath = public_path()."/public/img";

            $name = $image->getClientOriginalName();

            $image->move($absolutePath, $name);

            $pathRelative = "public/img/$name";
        }

        $produtos = new Produto;

        $produtos->title = $request->title;
        $produtos->image = $pathRelative;
        $produtos->content = $request->content;

        $produtos->save();

        if($produtos){
            return view('admProdutos')->with('success', 'Produto inserido com sucesso');
        }
    }
    

}