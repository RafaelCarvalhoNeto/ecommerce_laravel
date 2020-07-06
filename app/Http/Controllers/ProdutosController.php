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
         
        $imagem = $request->file('imagem');
        
        if(empty($imagem)){
            $pathRelative = null;
        } else{
            $imagem->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $imagem->getClientOriginalName();

            $imagem->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $produto = new Produto;

        $produto->nome = $request->inputProduto;
        $produto->imagem = $pathRelative;
        $produto->categoria = $request->inputCategoria;
        $produto->preco  = $request->inputPreco;
        

        $produto->save();

        if($produto){
            return view('admProdutos')->with('success', 'Produto inserido com sucesso');
        }
    } 
    

}