
@extends('layouts.app')
@section('title')
    Nossa Loja
@endsection
@section('content')
    <div class="container pt-3" id="carrosel">
        <div class="row">
            <div class="col-12">
            <div id="carouselHome" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <li data-target="#carouselHome" data-slide-to="1"></li>
                <li data-target="#carouselHome" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100"
                    src="/img/banner-06.png" alt="First slide">

                </div>

                <div class="carousel-item">
                    <img class="d-block w-100"
                    src="/img/banner-07.png" alt="Second slide">

                </div>

                <div class="carousel-item">
                    <img class="d-block w-100"
                    src="/img/banner-08.png" alt="Third slide">

                </div>
                </div>

                <a class="carousel-control-prev seta" href="#carouselHome" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next seta" href="#carouselHome" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
            </div>
        </div>
    </div>

    <!-- Card deck -->
    <section class="container">
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Mais Vendidos</h2>

        <div class="row mt-4">
            @foreach ($maisVendidos as $maisVendido)
            <div class="col-lg-3 col-sm-6 pb-1 mb-3">
                <a href="/detalheProduto/{{$maisVendido->produto->slug}}">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="{{ $maisVendido->produto->imagem != null ? asset($maisVendido->produto->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">{{ $maisVendido->produto->nome }}</h3>
                            <p class="card-text preco m-0">R$ {{number_format(($maisVendido->produto->precoFinal),2,',','.')}}</p>
                            <small class="text-left">{{$maisVendido->produto->parcelamento}}x de R$ {{number_format(($maisVendido->produto->precoFinal)/($maisVendido->produto->parcelamento),2,',','.')}} s/ juros</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </section>

    <!-- cards redondos -->
    <section class="container">
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Categorias em destaque</h2>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-3 d-flex justify-content-center pb-3">
                <a href="ofertas"><img src="img\bola1.png" class="icones"></a>
            </div>
            <div class="col-lg-3 col-md-3 d-flex justify-content-center pb-3">
                <a href=""><img src="img\bola2.png" class="icones"></a>

            </div>
            <div class="col-lg-3 col-md-3 d-flex justify-content-center pb-3">
                <a href=""><img src="img\bola3.png" class="icones"></a>
                
            </div>
            <div class="col-lg-3 col-md-3 d-flex justify-content-center pb-3">
                <a href=""><img src="img\bola4.png" class="icones"></a>
            </div>

        </div>
    </section>

    <!-- card deck -->
    <section class="container">
    <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Ofertas</h2>

        <div class="row mt-4">
            @foreach ($descontos as $desconto)


                <div class="col-lg-3 pb-1 col-sm-6 mb-3">
                    <a href="/detalheProduto/{{$desconto->slug}}">
                        <div class="card avancar">
                            <div class="card-header {{$desconto->promo>20?'bg-danger':'bg-success'}} text-white text-center">
                                <p class="faixa-promo">{{$desconto->promo}}% de desconto</p>
                            </div>
                            <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                <img src="{{ $desconto->imagem != null ? asset($desconto->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title produto">{{ $desconto->nome }}</h3>
                                <small class="promo">de R$ {{number_format(($desconto->precoOriginal),2,',','.')}} por</small>
                                <p class="card-text preco m-0">R$ {{number_format(($desconto->precoFinal),2,',','.')}}</p>
                                <small class="text-left">{{$desconto->parcelamento}}x de R$ {{number_format(($desconto->precoFinal)/($desconto->parcelamento),2,',','.')}} s/ juros</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Novidades na loja</h2>
        <div class="row mt-4">
            @foreach ($produtosBottom as $produtoBottom)
            <div class="col-lg-3 pb-1 col-sm-6 mb-3">
                <a href="/detalheProduto/{{$produtoBottom->slug}}">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="{{ $produtoBottom->imagem != null ? asset($produtoBottom->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">{{ $produtoBottom->nome }}</h3>
                            <p class="card-text preco m-0">R$ {{number_format(($produtoBottom->precoFinal),2,',','.')}}</p>
                            <small class="text-left">{{$produtoBottom->parcelamento}}x de R$ {{number_format(($produtoBottom->precoFinal)/($produtoBottom->parcelamento),2,',','.')}} s/ juros</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach    
        </div>
    </section>

@endsection