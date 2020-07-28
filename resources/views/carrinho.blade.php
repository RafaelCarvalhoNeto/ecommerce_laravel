@extends('layouts.app')
@section('title')
    Carrinho
@endsection
@section('content')

<section class="container-fluid m-0 p-0 ajuste">

    <div class="row jumbotron p-0 m-0 text-center">
        <h1 class="col-md-12 p-1 mt-3 mb-3">Carrinho</h1>
    </div>
    @php
    $total_pedido = 0;
    @endphp
    @forelse ($pedidos as $pedido)
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div id="table"  class="tableCarrinho">
                    <table class="table text-center mt-5">
                        <thead class="thead">
                            <tr>
                                <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                                <th scope="col">Preço Unitário</th>
                                <th scope="col">Descontos</th>
                                <th scope="col">Preço Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pedido->pedido_produtos as $pedido_produto)
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex">
                                        <img src="{{ $pedido_produto->produto->imagem }}" height="72" alt="">
                                        <div class="text-left mx-0 mx-md-3">
                                            <h5 class="my-0">{{ $pedido_produto->produto->nome }}</h5>
                                            <small class="text-muted my-0">{{ $pedido_produto->produto_id }}</small><br>
                                            <label class="mr-1" name="qtd"><small>Qtd</small></label>
                                            <select name="qtd">
                                                <option selected value={{ $pedido_produto->qtd }}>{{ $pedido_produto->qtd }}</option>
                                                <option value=2>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                                <option value=5>5</option>
                                            </select>
                                            <a href="#" class="ml-3 text-dark"><small>Excluir</small></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">R$ {{ number_format($pedido_produto->produto->valor, 2, ',', '.') }}</td>
                                <td class="align-middle font-weight-bold">R$ {{ number_format($pedido_produto->descontos, 2, ',', '.') }}</td>
                                @php
                                $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                                $total_pedido += $total_produto;
                                @endphp
                                <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td class="align-middle font-weight-bold">Total</td>
                                <td class="align-middle font-weight-bold">R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                            </tr>
                            
                        </tbody>
                    </table>        
                </div>
                @empty
                <div class="container" id="carrinhoVazio">
                <h2 class="my-3">Não há nenhum pedido no carrinho</h2>
                </div>
                @endforelse
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
    
            </div>
        </div>


    </div>




</section>


@endsection