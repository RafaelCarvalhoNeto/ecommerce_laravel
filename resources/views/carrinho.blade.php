@extends('layouts.app')
@section('title')
    Carrinho
@endsection
@section('content')

<section class="container-fluid m-0 p-0 ajuste">

    <div class="row jumbotron p-0 m-0 text-center">
        <h1 class="col-md-12 p-1 mt-3 mb-3">Carrinho</h1>
    </div>
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
            <div class="col-12 text-center">
                @forelse ($pedidos as $pedido)
                    <h5 class='col-12'>Pedido: {{$pedido->id}}</h5>
                    <h5 class='col-12'>Criado em: {{$pedido->created_at->format('d/m/Y H:i')}}</h5>
                    

                    <div id="table"  class="tableCarrinho">
                        <table class="table text-center mt-5">
                            <thead class="thead">
                                <tr>
                                    <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                                    <th scope="col">Qtd</th>
                                    <th scope="col">Preço Unitário</th>
                                    <th scope="col">Desconto</th>
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
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center-align">
                                        <div class="center-align">
                                            <a href="#" class="">
                                                <li><i class="fas fa-minus-circle"></i></li>
                                            </a>
                                            <span>{{$pedido_produto->qtd}}</span>
                                            <a href="#" class="">
                                                <li><i class="fas fa-plus-circle"></i></li>
                                            </a>
                                        </div>
                                        <a href="#" class="tooltiped" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho">Retirar produto</a>
                                        
                                    </td>
                                    <td class="align-middle">{{number_format($pedido_produto->produto->preco, 2, ',','.')}}</td>
                                    <td class="align-middle font-weight-bold">{{number_format($pedido_produto->produto->descontos, 2, ',','.')}}</td>
                                    @php
                                        $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                                        $total_pedido += $total_produto;
                                    @endphp
                                    <td>R$ {{number_format($total_produto, 2, ',','.')}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
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
                            <a class="btn btn-primary" href="/finalizarCompra">Finalizar Compra</a>
                        </div>
                    </div>
                @empty
                <h5>Não há nenhum pedido no carrinho</h5>
                @endforelse
    
            </div>
        </div>


    </div>




</section>


@endsection