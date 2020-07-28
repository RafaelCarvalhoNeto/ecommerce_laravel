<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class CarrinhoController extends Controller
{
    function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        $pedidos = Pedido::where([
            'status'=>'RE',
            'user_id'=>Auth::id()
        ])->get();

        return view('carrinho', compact('pedidos'));
    }

    public function adicionar(){
        $this->middleware('VerifyCsrfToker');

        $req = Request();
        $idproduto = $req->input('id');

        $produto = Produto::find($idproduto);
        if(empty($produto->id)){
            $req->session()->flash('mensagem falha', 'Produto não encontrado na nossa loja!');
            return redirect()->route('carrinho');
        }

        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'user_id'=>$idusuario,
            'status'=> 'RE'
        ]);
        
        if(empty($idpedido)){
            $pedido_novo = Pedido::create([
                'user_id'=>$idusuario,
                'status'=>'RE'
            ]);

            $idpedido = $pedido_novo->id;
        }

        PedidoProduto::create([
            'pedido_id'=>$idpedido,
            'produto_id'=>$idproduto,
            'valor'=>$produto->preco,
            'status'=>'RE'
        ]);
        
        $req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho');
    }

    // public function remover(){
    //     $this->middleware('VerifyCsrfToker');

    //     $req = Request();
    //     $idpedido = $req->input('pedido_id');
    //     $idproduto = $req->input('produto_id');
    //     $remove_apenas_item = (boolean)$req->input('item');
    //     $idusuario = Auth::id();
    // }
}