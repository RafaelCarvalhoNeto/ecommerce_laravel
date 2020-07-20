@extends('layouts.app')
@section('title')
    Carrinho
@endsection
@section('content')

<section class="container-fluid m-0 p-0 ajuste">

    <div class="row jumbotron p-0 m-0 text-center">
        <h1 class="col-md-12 p-1 mt-3 mb-3">Carrinho</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div id="table"  class="tableCarrinho">
                    <table class="table text-center mt-5">
                        <thead class="thead">
                            <tr>
                                <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                                <th scope="col">Preço Unitário</th>
                                <th scope="col">Preço Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex">
                                        <img src="/img/celular.jpg" idth="72" height="72" alt="">
                                        <div class="text-left mx-0 mx-md-3">
                                            <h5 class="my-0"> {{ $row->nome }} </h5>
                                            <small class="text-muted my-0">Indentificação do produto</small><br>
                                            <label class="mr-1" name="qtd"><small>{{ $row->qty }}</small></label>
                                            <select name="qtd">
                                                <option selected value=1>1</option>
                                                <option value=2>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                                <option value=5>5</option>
                                            </select>
                                            <a href="#" class="ml-3 text-dark"><small>Editar</small></a>
                                            <a href="#" class="ml-3 text-dark"><small>Excluir</small></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $row->preco }}</td>
                                @endforeach
                                <td class="align-middle font-weight-bold">{{ $row->total }}</td>
                            </tr>
                            
                            @php dd($produto); @endphp
                            
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
    
            </div>
        </div>


    </div>




</section>


@endsection