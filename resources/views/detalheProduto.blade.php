@extends('layouts.app')
@section('title')
    {{$produto->nome}}
@endsection
@section('content')
    <section class="container mt-3">
        <div class="row">
            <div class="col-12">
                <p><small><a href="/">Página inicial</a> > <a href='/categoria/{{$categoria->slug}}'>{{$categoria->tipo}}</a> > {{$produto->nome}}</small></p>
            </div>
            <div class="col-md-6 my-3">
                <div>
                    <img class="d-block w-100 .produto" src=" {{asset($produto->imagem)}} " alt="" >
                </div>
            </div>
            <div class="col-md-6 my-3 d-flex flex-column justify-content-between">
                <div>

                    <h2>{{$produto->nome}}</h2>
                    <small>{{$produto->id}}</small>
                    <p class="my-3">{{$produto->descricao}}
                    </p>
                </div>
                <div class="container align-self-end">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column justify-content-center bg-light ">
                            <div class="form-group mt-4 mb-2">
                                <p class="m-0"  id="precoDetalhe">R$ {{number_format(($produto->preco),2)}}</p>
                                <small>{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2)}} s/ juros</small>
                            </div>
                            <div class="form-group m-0 mb-4">
                                <form action="{{route('carrinho.adicionar')}}" method="POST" id="formComprar">
                                    @csrf
                                    <input type="hidden" name="id" value={{$produto->id}}>
                                    <button type="submit" class="mx-auto my-2 btn btn-primary font-weight-bold comprar"><i class="fas fa-shopping-cart mr-2"></i>comprar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>

        <!-- ACCORDION -->
        <div class="row">
            <div class="col-12 my-5">
                <div class="accordion" id="accordionTabsProduto">
                    <div>
                        <button class="acordeao my-2" type="button" data-toggle="collapse" data-target="#titulo1" aria-expanded="false" aria-controls="titulo1"><p class="m-0"> Ficha Técnica <i class="fas fa-chevron-down ml-3 font-weight-light"></i></p>
                        </button>

                        <div id="titulo1" class="collapse" aria-labelledby="aba01" data-parent="#accordionTabsProduto">
                            <div class="card-body">

                                <table class="table table-striped text-center">
                                    <tbody>
                                        @foreach($informacoes as $tecnicas => $info)
                                            <tr>
                                                <th scope="col">{{ $tecnicas}}</th>
                                                <td>{{$info}}</td>
                                            </tr>
                                                
                                            
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="acordeao my-2" type="button" data-toggle="collapse" data-target="#titulo2" aria-expanded="false" aria-controls="titulo2"><p class='m-0'>Avaliações <i class="fas fa-chevron-down ml-3 font-weight-light"></i></p>
                        </button>

                        <div id="titulo2" class="collapse" aria-labelledby="aba02" data-parent="#accordionTabsProduto">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, nobis delectus! Sequi, ipsum exercitationem neque blanditiis provident officia. Officia distinctio totam hic repellat! Delectus, reiciendis? Quae nobis optio provident minus?
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>


    <div class="container">
        <div class="row mt-4">
            @foreach ($recomendacoes as $recomendacao)
            <div class="col-md-3 pb-1 pb-md-0 mb-3">
                <a href="/detalheProduto/{{$recomendacao->slug}}">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="{{ $recomendacao->imagem != null ? asset($recomendacao->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">{{ $recomendacao->nome }}</h3>
                            <p class="card-text preco m-0">R$ {{ number_format($recomendacao->preco,2)}}</p>
                            <small class="text-left">{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2)}} s/ juros</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
    </div>


@endsection