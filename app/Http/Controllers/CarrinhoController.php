<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;
use App\Cart;
use Session;

class CarrinhoController extends Controller
{
    // function __contruct(){
    //     $this->middleware('auth');
    // }

    public function index(){

        if(Auth::check()===true){
            $pedidos = Pedido::where([
                'status'=>'RE',
                'user_id'=>Auth::id()
            ])->get();
        
            return view('carrinho', compact('pedidos'));
            
        }

        // ALTERNATIVA DE VISUALIZAR CARRINHO ATRAVÉS DE INFOS NA SESSÃO
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('carrinho')->with([
            'produtos'=>$cart->produtos, 'totalPrice'=>$cart->totalPrice
        ]);

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

        // ADICIONAR ATRAVÉS DE SESSÃO
        if(Auth::check()===false){

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($produto, $produto->id);

            $req->session()->put('cart', $cart);

            if($req->input('back')){
                return redirect()->back();
            }
            
            $req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');
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
            'valor'=>$produto->precoFinal,
            'status'=>'RE'
        ]);

        if($req->input('back')){
            return redirect()->back();
        }
        
        $req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho');
    }

    // REMOVER ATRAVÉS DE SESSÃO
    public function removerItemSession(){
        $this->middleware('VerifyCsrfToker');

        $req = Request();
        $idproduto = $req->input('id');

        if(Auth::check()===false){

            $produto = Produto::find($idproduto);
            $item = (boolean)$req->input('item');

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->remove($produto, $produto->id, $item);

            $req->session()->put('cart', $cart);

            if(!empty($cart->produtos)){
                $req->session()->flash('mensagem-sucesso', 'Produto removido com sucesso!');
            } else{
                $req->session()->forget('cart');

            }
            
            return redirect()->route('carrinho');
            
        }

    }

    public function remover(){

        $this->middleware('VerifyCsrfToker');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idproduto = $req->input('produto_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'id' => $idpedido,
            'user_id'=> $idusuario,
            'status'=> 'RE'
        ]);

        if( empty($idpedido)){
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado');
            return redirect()->route('carrinho');
        }

        $where_produto = [
            'pedido_id' => $idpedido,
            'produto_id'=>$idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if(empty($produto->id)){
            $req->session()->flash('mensagem-falha', "Produto não encontrado no carrinho!");
            return redirect()->route('carrinho');
        }

        if($remove_apenas_item){
            $where_produto['id'] = $produto->id;
        }

        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where(['pedido_id'=>$produto->pedido_id])->exists();

        // print_r($check_pedido);
        // die;

        if(!$check_pedido){
            Pedido::where([
                'id'=>$produto->pedido_id
            ])->delete();
        }

        $req->session()->flash('mensagem-sucesso', 'Produto removido com sucesso!');

        return redirect()->route('carrinho');

    }

    // >>> CONVERTER OS PRODUTOS NA SESSION EM ITENS DA BASE DE DADOS
    public function converterPedido(){




        if(Auth::check()===false){
            return redirect()->route('login.direct');

        }

        $cart = Session::get('cart');
        // echo '<pre>';
        // echo print_r($cart);
        // echo '</pre>';
        // die;



        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'user_id'=>$idusuario,
            'status'=> 'RE'
        ]);

        $check_items = PedidoProduto::where(['pedido_id'=>$idpedido])->exists();

        if($idpedido){
            if($check_items){
                PedidoProduto::where(['pedido_id'=>$idpedido])->delete();
            }
            Pedido::where([
                'id'=>$idpedido
            ])->delete();
        }

        $pedido_novo = Pedido::create([
            'user_id'=>$idusuario,
            'status'=>'RE'
        ]);

        $idpedido = $pedido_novo->id;

        $produtos = $cart->produtos;

        foreach ($produtos as $produto) {
            for ($i=0;$i<$produto['qtd'];$i++){
                PedidoProduto::create([
                    'pedido_id'=>$idpedido,
                    'produto_id'=>$produto['produto']['id'],
                    'valor'=>$produto['produto']['precoFinal'],
                    'status'=>'RE'
                ]);

            }
        }

        return redirect()->route('pagina.finalizar');

    }

    public function concluir(){
        $this->middleware('VerifyCsrfToker');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idusuario = Auth::id();


        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'user_id'=>$idusuario,
            'status'=>'RE'
        ])->exists();
        
        if(!$check_pedido){
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado');
            return redirect()->route('carrinho');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id'=>$idpedido,
            'status'=>'RE'
        ])->exists();

        if(!$check_produtos){
            $req->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho');
        }

        PedidoProduto::where([
            'pedido_id'=>$idpedido
        ])->update([
            'status'=> 'PA'
        ]);
        Pedido::where([
            'id'=>$idpedido
        ])->update([
            'status'=>'PA'
        ]);

        $pedido = Pedido::where([
            'id'=>$idpedido
        ])->first();

        return view('compraFinalizada')->with('pedido', $pedido);

    }

    public function compras(Request $request){
        
        if(Auth::check()===true){
            $pedidos = Pedido::where([
                'status'=>'RE',
                'user_id'=>Auth::id()
            ])->get();
        
            return view('usuarios.finalizarCompra', compact('pedidos'));
            
        }
        
    }

    // HISTÓRICO DE PEDIDOS
    public function showHistorico(){
        $pedidos = Pedido::where([
            'status'=>'PA',
            'user_id'=> Auth::id()
        ])->orderBy('updated_at', 'desc')->get();

        return view('usuarios.historicoPedidos', compact('pedidos'));
    }
}