@extends('layouts.app')
@section('content')
    <section class="container mt-3">
        <div class="row">
            <div class="col-12">
                <p><small><a href="/">Página inicial</a> > <a href='/categoria/{{$categoria[0]->slug}}'>{{$categoria[0]->tipo}}</a> > {{$produto->nome}}</small></p>
            </div>
            <div class="col-md-6 my-3">
                <div>
                    <img class="d-block w-100 .produto" src=" {{asset($produto->imagem)}} " alt="" >
                </div>
            </div>
            <div class="col-md-6 my-3">
                <h2>{{$produto->nome}}</h2>
                <small>{{$produto->id}}</small>
                <p class="my-3">{{$produto->descricao}}
                </p>
                <form action="./carrinho" method="GET" id="formComprar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 p-0">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="quantidade">Quantidade</label>
                                        <input type="number" class="form-control" id="quantidade" step="1" min="1" value="1" required>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex flex-column justify-content-center bg-light ">
                                <div class="form-group mt-4 mb-2">
                                    <p class="m-0"  id="precoDetalhe">R$ {{number_format(($produto->preco),2)}}</p>
                                    <small>{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2)}} s/ juros</small>
                                </div>
                                <div class="form-group m-0 mb-4">
                                    <button type="submit" class="mx-auto my-2 btn btn-primary font-weight-bold comprar"><i class="fas fa-shopping-cart mr-2"></i>comprar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


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
                <a href="/detalheProduto/{{$recomendacao->id}}">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="{{ $recomendacao->imagem != null ? asset($recomendacao->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">{{ $recomendacao->nome }}</h3>
                            <p class="card-text preco m-0">R$ {{ $recomendacao->preco }}</p>
                            <small class="text-left">{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2)}} s/ juros</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
    </div>


@endsection