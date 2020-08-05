<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PedidoProduto;
use Session;

class NavigateController extends Controller
{
    public function index(){
        $produtos = Produto::paginate(8);
        $descontos = Produto::where('empromo',1)
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();
        
        $produtosBottom = DB::table('produtos')->latest()->take(4)->get();

        $maisVendidos = PedidoProduto::select(\DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd'))
        ->where('status','=','PA')
        ->groupBy('produto_id')
        ->orderBy('qtd', 'desc')
        ->take(8)->get();

        if($produtos && $descontos && $produtosBottom){
            return view('index')->with([
                'produtos'=> $produtos,
                'descontos'=> $descontos,
                'produtosBottom'=> $produtosBottom,
                'maisVendidos'=>$maisVendidos
            ]);
        }
    }

    public function showDetails($slug){
        $produto = Produto::where('slug', '=', $slug)
        ->first();

        $recomendacoes = DB::table('produtos')
        ->join('categorias', 'produtos.categoria','=', 'categorias.id')
        ->where('categorias.id', $produto->categoria)
        ->select('produtos.nome', 'produtos.imagem', 'produtos.precoFinal', 'produtos.id','produtos.parcelamento', 'produtos.slug')
        ->paginate(4);

        $categoria = Categoria::where('id', '=', $produto->categoria)
        ->first();

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
        ->select('produtos.nome', 'produtos.imagem', 'produtos.precoFinal', 'produtos.id','produtos.parcelamento', 'produtos.slug')
        ->paginate(16);

        $categoria = Categoria::where('slug', '=', $url)
        ->first();      

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
        $maxPrice = $produtos->get()->max('precoFinal');
        
        if($precoBuscado){
            $produtos = $produtos->where('precoFinal', '<', $precoBuscado);

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
        if(Auth::check()===true){
            return redirect()->route('index');
        }
        return view('loginDirect');
    }

    public function login(Request $request){

        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $cart = Session::get('cart');

        if (Auth::attempt($credentials)){
            return redirect()->route('converter.pedido');

        }
        return redirect()->back()->withInput()->withErros(['Os dados informados não conferem!']);
    }


}
