<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Produto  $produto
     * 
     */
    public function store(Produto $produto)
    {
        dd($produto);

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($produto) {
            return $cartItem->id === $produto->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('/carrinho')->with('success_message', 'Item já está no seu carrinho!');
        }

        Cart::add($produto->nome, $produto->imagem, 1, $produto->preco, $produto->parcelamento)
            ->associate('App\Produto')

        dd(Cart::content());
        return redirect()->route('/carrinho')->with('success_message', 'Item adicionado ao carrinho');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
