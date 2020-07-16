@extends('layouts.app')
@section('content')

<section class="container-fluid m-0 p-0 ajuste">

    <div class="row jumbotron p-0 m-0 text-center">
        <h1 class="col-md-12 p-1 mt-3 mb-3">Carrinho</h1>
    </div>
    @if(isset($success) && $success != "")
    <section class="row">
        <div class="col-12">
            <div class="message alert alert-success text-center">
                {{ $success }}
            </div>
        </div>
    </section> 
    @endif
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Cart::count() > 0)

<h2>{{ Cart::count() }} iten(s) no Carrinho</h2>
    <div class="container">
        @foreach (Cart::content() as $item)

        <div class="row">
            <div class="col-12 text-center">
                <table class="table text-center mt-5">
                    <thead class="thead">
                        <tr>
                            <th scope="col" colspan="2" class="text-left"><h4 class="mb-0">Itens selecionados</h4></th>
                            <th scope="col">Preço Unitário</th>
                            <th scope="col">Preço Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="d-flex">
                                <a href="/detalheProduto/{{$produto->id}}"><img src="{{ produtoImagem($item->model->image) }}" height="72" alt=""></a>
                                    <div class="text-left mx-0 mx-md-3">
                                        <h5 class="my-0">{{ $item->model->nome }}</h5>
                                        <small class="text-muted my-0">{{ $item->model->id }}</small><br>
                                        <label class="mr-1" name="qtd"><small>Qtd</small></label>
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
                            <td class="align-middle">R$ 900,00</td>
                            <td class="align-middle font-weight-bold">R$ 900,00</td>
                        </tr>
                        
                    </tbody>
                </table>
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
        @endforeach
        @else

        <h3>No há nenhum iten no carrinho!</h3>
        <div class="spacer"></div>
        <a href="{{ route('index') }}" class="button">Continue a Navegar</a>
        <div class="spacer"></div>

        @endif

    </div>




</section>


@endsection