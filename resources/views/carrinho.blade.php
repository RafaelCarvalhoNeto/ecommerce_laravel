@extends('layouts.app')
@section('title')
    Carrinho
@endsection
@section('content')

<section class="container pt-3 ajuste">

    <h2 class="col-12 p-3 mb-3 border-bottom">Carrinho</h2>
    @if(session('mensagem-sucesso'))
    <section class="row">
        <div class="col-12">
            <div class="message alert alert-success text-center">
                {{ session('mensagem-sucesso') }}
            </div>
        </div>
    </section>
    @endif
    @if(session('mensagem-falha'))
    <section class="row">
        <div class="col-12">
            <div class="message alert alert-danger text-center">
                {{ session('mensagem-falha') }}
            </div>
        </div>
    </section>
    @endif

    <div class="container">
        <div class="row">

            @guest
            @if (session()->has('cart'))
                <div class="col-12 text-center">
                    
                    <div id="table"  class="tableCarrinho">
                        <table class="table text-center mt-3 tableCarrinho">
                            <thead class="thead">
                                <tr>
                                    <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                                    <th scope="col">Qtd</th>
                                    <th scope="col">Preço Unitário</th>
                                    <th scope="col">Preço Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)  
                                <tr>
                                    <td colspan="2">
                                        <div class="d-flex">
                                            <img src="{{$produto['produto']['imagem']}}" idth="72" height="72" alt="">
                                            <div class="text-left mx-0 mx-md-3">
                                                <h5 class="my-0"> {{$produto['produto']['nome']}}</h5>
                                                <small class="text-muted my-0">{{$produto['produto']['id']}}</small><br>
                                                {{-- <a href="#" class="ml-3 text-dark"><small>Editar</small></a>
                                                <a href="#" class="ml-3 text-dark"><small>Excluir</small></a> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center-align">
                                        <div class="center-align setas-add-cart">
                                            <a href="#" class="">
                                                <li><i class="fas fa-minus" onclick="carrinhoRemoverProdutoSession({{$produto['produto']['id']}},1)"></i></li>
                                            </a>
                                            <span>{{$produto['qtd']}}</span>
                                            <a href="#" class="">
                                                <li><i class="fas fa-plus" onclick="carrinhoAdicionarProduto({{$produto['produto']['id']}})"></i></li>
                                            </a>
                                        </div>
                                        <a href="#" class="retirar-pedido" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho" onclick="carrinhoRemoverProdutoSession({{$produto['produto']['id']}},0)">Retirar produto</a>
                                        
                                    </td>
                                    <td class="align-middle">R$ {{number_format($produto['produto']['preco'],2,',','.')}}</td>
                                    <td class='align-middle  font-weight-bold'>R$ {{number_format($produto['price'],2,',','.')}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="align-middle font-weight-bold">Total</td>
                                    <td class="align-middle font-weight-bold">R$ {{number_format($totalPrice,2,',','.')}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="form-inline">
                        <div class="form-group col-md-6">
                            <label for="cupomDesconto" class="col-auto pl-0">Cupom de Desconto</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="cupomDesconto" id="cupomDesconto" placeholder="INSIRA SEU CUPOM">
                            </div>
                        </div>
                        <div class="form-group col-md-2 offset-4">
                            <form action="{{route('converter.pedido')}}" method='get'>
                                @csrf
                                <button type='submit' class="btn btn-primary">Finalizar Compra</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else

                <div class="col-md-12 p-0 text-center">
                    <div class="my-4 p-5 p-auto border ">
                        <h4 class="font-weight-bold">Seu carrinho está vazio</h4>
                        <a class="text-secondary" href="/">Volte para a página inicial</a>

                    </div>
                </div>


            @endif

            @else
                @forelse ($pedidos as $pedido)
                    <div class="col-12 text-center">
                    
                        <div id="table"  class="tableCarrinho">
                            <table class="table text-center mt-3 tableCarrinho">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                                        <th scope="col">Qtd</th>
                                        <th scope="col">Preço Unitário</th>
                                        <th scope="col">Preço Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_pedido = 0;
                                    @endphp
                                    @foreach ($pedido->pedido_produtos as $pedido_produto)
                                        
                                    <tr>
                                        <td colspan="2">
                                            <div class="d-flex">
                                                <img src="{{$pedido_produto->produto->imagem}}" idth="72" height="72" alt="">
                                                <div class="text-left mx-0 mx-md-3">
                                                    <h5 class="my-0"> {{$pedido_produto->produto->nome}}</h5>
                                                    <small class="text-muted my-0">{{$pedido_produto->produto->id}}</small><br>
                                                    <a href="#" class="ml-3 text-dark"><small>Editar</small></a>
                                                    <a href="#" class="ml-3 text-dark"><small>Excluir</small></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="center-align">
                                            <div class="center-align setas-add-cart">
                                                <a href="#" class="" onclick="carrinhoRemoverProduto({{$pedido->id}}, {{$pedido_produto->produto_id}},1)">
                                                    <li><i class="fas fa-minus"></i></li>
                                                </a>
                                                <span>{{$pedido_produto->qtd}}</span>
                                                <a href="#" class="" onclick="carrinhoAdicionarProduto({{$pedido_produto->produto_id}})">
                                                    <li><i class="fas fa-plus"></i></li>
                                                </a>
                                            </div>
                                            <a href="#" class="retirar-pedido" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho" onclick="carrinhoRemoverProduto({{$pedido->id}}, {{$pedido_produto->produto_id}},0)">Retirar produto</a>
                                            
                                        </td>
                                        <td class="align-middle">R$ {{number_format($pedido_produto->produto->preco, 2, ',','.')}}</td>
                                        @php
                                            $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                                            $total_pedido += $total_produto;
                                        @endphp
                                        <td class='align-middle  font-weight-bold'>R$ {{number_format($total_produto, 2, ',','.')}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="align-middle font-weight-bold">Total</td>
                                        <td class="align-middle font-weight-bold">R$ {{number_format($total_pedido, 2, ',','.')}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="form-inline">
                            <div class="form-group col-md-6">
                                <label for="cupomDesconto" class="col-auto pl-0">Cupom de Desconto</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="cupomDesconto" id="cupomDesconto" placeholder="INSIRA SEU CUPOM">
                                </div>
                            </div>
                            <div class="form-group col-md-2 offset-4">
                                <form action="{{route('pagina.finalizar')}}" method='get'>
                                    <button type='submit' class="btn btn-primary">Finalizar Compra</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-0 text-center">
                        <div class="my-4 p-5 p-auto border ">
                            <h4 class="font-weight-bold">Seu carrinho está vazio</h4>
                            <a class="text-secondary" href="/">Volte para a página inicial</a>

                        </div>
                    </div>
                    
                @endforelse            
            
            
            @endguest

    


        </div>


    </div>

    @guest
    
        <form id="form-remover-produto-session" method='post' action="{{ route('carrinho.remover.ss')}}">
            @csrf
            <input type="hidden" name="id">
            <input type="hidden" name="item">
        </form>

    @else

        <form id="form-remover-produto" method='post' action="{{ route('carrinho.remover')}}">
            @csrf
            {{ method_field('DELETE') }}
            <input type="hidden" name="pedido_id">
            <input type="hidden" name="produto_id">
            <input type="hidden" name="item">

        </form>

    @endguest

    <form id="form-adicionar-produto" method="post" action="{{ route('carrinho.adicionar')}}">
        @csrf 
        <input type="hidden" name="id">
    </form>




</section>

<script src='./js/carrinho.js'></script>


@endsection