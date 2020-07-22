<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NavigateController extends Controller
{
    public function index(){
        $produtos = Produto::paginate(8);
        $descontos = Produto::where('categoria',1)->take(4)->get();
        $produtosBottom = DB::table('produtos')->latest()->take(4)->get();
        
        if($produtos && $descontos && $produtosBottom){
            return view('index')->with([
                'produtos'=> $produtos,
                'descontos'=> $descontos,
                'produtosBottom'=> $produtosBottom
            ]);
        }
    }

    public function showDetails($slug){
        $produto = Produto::where('slug', '=', $slug)
        ->first();

        $recomendacoes = DB::table('produtos')
        ->join('categorias', 'produtos.categoria','=', 'categorias.id')
        ->where('categorias.id', $produto->categoria)
        ->select('produtos.nome', 'produtos.imagem', 'produtos.preco', 'produtos.id','produtos.parcelamento', 'produtos.slug')
        ->paginate(4);

        $categoria = Categoria::where('id', '=', $produto->categoria)
        ->first();

        // print_r($produto->categoria);


        if($produto){
            $arrayinfos = $produto->informacoes;
            $informacoes = json_decode($arrayinfos, true);
            return view('detalheProduto')->with([
                'produto' => $produto,
                'informacoes' => $informacoes,
                'recomendacoes' => $recomendacoes,
                'categoria' => $categoria
            ]);
        }
    }

    public function pagCategorias($url){
        
        $produtos = DB::table('produtos')
        ->join('categorias', 'produtos.categoria','=', 'categorias.id')
        ->where('categorias.slug', $url)
        ->select('produtos.nome', 'produtos.imagem', 'produtos.preco', 'produtos.id','produtos.parcelamento', 'produtos.slug')
        ->paginate(16);

        $categoria = Categoria::where('slug', '=', $url)
        ->first();

        // print_r($categoria);
        

        if($produtos){
            return view('categoria')->with([
                'produtos'=> $produtos,
                'categoria'=> $categoria,
            ]);
        }
    }

    public function searchItems(Request $request){

        $search = $request->input('search');
        $precoBuscado = intval($request->input('preco'));
        $produtos = Produto::where('nome', 'like', '%'.$search.'%');
        $maxPrice = $produtos->get()->max('preco');
        
        if($precoBuscado){
            $produtos = $produtos->where('preco', '<', $precoBuscado);

        } else{
            $produtos = Produto::where('nome', 'like', '%'.$search.'%');
        }
        $found = $produtos->count();
        $produtos = $produtos->paginate(16);

        return view('busca')->with([
            'search'=>$search,
            'produtos'=>$produtos,
            'maxPrice'=>$maxPrice,
            'precoBuscado'=> $precoBuscado,
            'found'=>$found,
        ]);
    }


    // AUTH USUÁRIO

    public function finalizarPedido(){
        if(Auth::check()===true){
            return view('usuarios.finalizarCompra');
        }
        return redirect()->route('login.direct');
    }
    
    public function loginDirect(){
        return view('loginDirect');
    }

    public function login(Request $request){

        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if (Auth::attempt($credentials)){
            return redirect()->route('finaliza.compra');

        }
        return redirect()->back()->withInput()->withErros(['Os dados informados não conferem!']);
    }


}
