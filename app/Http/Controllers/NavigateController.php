<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class NavigateController extends Controller
{
    public function index(){
        $produtos = Produto::paginate(8);
        $descontos = Produto::where('categoria',1)->take(4);
        $produtosBottom = Produto::paginate(4);
        
        if($produtos && $descontos && $produtosBottom){
            return view('index')->with([
                'produtos'=> $produtos,
                'descontos'=> $descontos,
                'produtosBottom'=> $produtosBottom
            ]);
        }
    }

    public function showDetails($id){
        $produto = Produto::find($id);
        $recomendacoes = Produto::paginate(4);

        if($produto){
            $arrayinfos = $produto->informacoes;
            $informacoes = json_decode($arrayinfos, true);
            return view('detalheProduto')->with([
                'produto' => $produto,
                'informacoes' => $informacoes,
                'recomendacoes' => $recomendacoes,
            ]);
        }
    }
}