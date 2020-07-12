<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutosController extends Controller
{
    public function index() {

        $produtos = Produto::paginate(10);

        if($produtos){
            return view('admin.admProdutos')->with('produtos', $produtos);
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
        $produto->descricao = $request->inputDescricao;
        

        $produto->save();

        if($produto){
            $produtos = Produto::paginate(10);
            return view('admin.admProdutos')->with([
                'produtos'=> $produtos,'success'=>'Usuário alterado com sucesso'
                ]);
        }
    } 
    
    public function edit($id){
        $produto = Produto::find($id);
        if($produto){
            return view('admin.admProdutos')->with('produto', $produto);
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:30'
        ]);

        $produto = Produto::find($id);
        $produto->title = $request->title;
        $produto->content = $request->content;

        $produto->update();

        if($produto){
            return view('produtos.edit')->with([
                'produto' => $produto,
                'success' => 'Cartão atualizado com sucesso'
            ]);
        }
    }
    public function delete($id){
        
        $produto = Produto::find($id);

        if($produto->delete()){

            $produtos = Produto::paginate(10);

            return view('admin.admProdutos')->with([
                'produtos' => $produtos,
                'success' => 'Registro excluído com sucesso'
            ]);
        }
    }

    public function search(Request $request){

        $search = $request->input('search');

        $produtos = Produto::where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('admin.admProdutos')->with([
            'search' => $search,
            'produtos' => $produtos
        ]);
    }
}