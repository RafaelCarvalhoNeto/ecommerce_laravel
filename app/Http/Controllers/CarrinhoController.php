<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carrinho');
    }


public function store(Request $request)
{
    Cart::add($request->nome, $request->imagem, $request->preco, $request->parcelamento)
    ->associate('App\Produto')

    return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
}