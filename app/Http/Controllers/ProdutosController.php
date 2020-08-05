<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{
    public function index() {

        if(Auth::check()===true){
            if(Auth::user()->admin==1){

                $produtos = DB::table('produtos')
                ->leftjoin('categorias', 'produtos.categoria','=', 'categorias.id')
                ->select('produtos.nome', 'produtos.imagem', 'produtos.precoOriginal', 'produtos.id','categorias.tipo',
                'produtos.descricao', 'produtos.parcelamento','produtos.promo', 'produtos.empromo','produtos.precoFinal', 'produtos.informacoes');
                $categorias = Categoria::All();
                $found = $produtos->count();
                $produtos = $produtos->paginate(10);
                   
                if($produtos){
                    return view('admin.admProdutos')->with(['produtos'=> $produtos,'found'=> $found, 'categorias'=> $categorias]);
                }
            }
        }

        return redirect()->route('admin.login');
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
        $produto->precoOriginal  = $request->inputPreco;
        $produto->precoFinal  = $request->inputPreco;
        $produto->descricao = $request->inputDescricao;
        $produto->parcelamento = $request->inputParcelamento;

        $qtd = $request->infosQtd;

        $req = Request();

        $informacoes = [];
        for($i=1;$i<=$qtd;$i++){
            $informacoes[$req->input('inputTitulo'.$i)] = $req->input('inputConteudo'.$i);
        }

        $arrayinfos = json_encode($informacoes);

        $produto->informacoes = $arrayinfos;
        

        $produto->save();

        if($produto){
            return redirect()->route('admin.admProdutos')->with('success','Produto criado com sucesso!');
        }
    } 

    public function update(Request $request, $id){
        $produto = Produto::find($id);
        $imagem = $request->file('imagem');
        
        if(empty($imagem)){
            $pathRelative = $request->imagemName;
        } else{
            $imagem->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $imagem->getClientOriginalName();

            $imagem->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $produto->nome = $request->inputProduto;
        $produto->imagem = $pathRelative;
        $produto->categoria = $request->inputCategoria;
        $produto->precoOriginal  = $request->inputPreco;
        if ($produto->empromo ==1){
            $produto->precoFinal  = ($request->inputPreco)*(1-$produto->promo/100);
        } else {
            $produto->precoFinal  = $request->inputPreco;
        }
        $produto->descricao = $request->inputDescricao;
        $produto->parcelamento = $request->inputParcelamento;

        $qtd = $request->qtdEdit;

        $req = Request();

        $informacoes = [];
        for($i=1;$i<=$qtd;$i++){
            $informacoes[$req->input('inputTituloEdit'.$i)] = $req->input('inputConteudoEdit'.$i);
        }

        $arrayinfos = json_encode($informacoes);

        $produto->informacoes = $arrayinfos;
        
        $produto->update();
        
        if($produto){
            return redirect()->back()->with('success','Produto alterado com sucesso!');

        }
    }

    public function promoUpdate(Request $request, $id){
        $produto = Produto::find($id);
        
        if($request->empromo==1){
            $produto->empromo = $request->empromo;
            $produto->promo = $request->promoDesc;
            $produto->precoFinal = $request->inputDesconto;
        } else {
            $produto->empromo = 0;
            $produto->promo = null;
            $produto->precoFinal = $produto->precoOriginal;
        }
        $produto->update();
        
        if($produto){
            return redirect()->route('admin.admProdutos')->with('success','Produto alterado com sucesso!');

        }
    }

    public function delete($id){
        
        $produto = Produto::find($id);

        if($produto->delete()){

            if($produto){
                return redirect()->route('admin.admProdutos')->with('success','Produto excluído com sucesso!');
    
            }
            
        }
    }
    
    public function search(Request $request){

        $search = $request->input('inputSearch');

        $produtos = DB::table('produtos')
        ->leftjoin('categorias', 'produtos.categoria','=', 'categorias.id')
        ->select('produtos.nome', 'produtos.imagem', 'produtos.precoOriginal', 'produtos.id','categorias.tipo', 'produtos.parcelamento', 'produtos.descricao','produtos.promo', 'produtos.empromo','produtos.precoFinal', 'produtos.informacoes')
        ->where('produtos.nome', 'like' , '%'. $search . '%')
        ->orWhere('categorias.tipo', 'like' , '%'. $search . '%');
        $categorias = Categoria::All();
        $found = $produtos->count();
        $produtos = $produtos->paginate(10);

        return view('admin.admProdutos')->with([
            'search' => $search,
            'produtos' => $produtos,
            'categorias'=> $categorias,
            'found'=> $found
        ]);
    }


    public function faturamento(){

        if(Auth::check()===true){
            if(Auth::user()->admin==1){

                $maisVendidos = Produto::all();
        
                if($maisVendidos){
                    return view('admin.fatProdutos')->with([
                        'maisVendidos'=> $maisVendidos
                    ]);
                }

                // return $maisVendidos[0]->cat;
                // die;

            }
        }
        return redirect()->route('admin.login');
    }



}
