@extends('layouts.app')
@section('content')

<div class="container pt-3">
    <h2 class="col-12 p-3 mb-3 border-bottom">{{$categoria}}</h2>

    <div class="mb-3 col-lg-12 px-0">
        <img class="d-block w-100" src="/img/banner-07.png" >
    </div>

    <div class="row mt-4">
        @foreach ($produtos as $produto)
        <div class="col-md-3 pb-1 pb-md-0 mb-3">
            <a href="/detalheProduto/{{$produto->id}}">
                <div class="card avancar">
                    <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                        <img src="{{ $produto->imagem != null ? asset($produto->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title produto">{{ $produto->nome }}</h3>
                        <p class="card-text preco m-0">R$ {{number_format(($produto->preco),2)}}</p>
                        {{-- <small class="text-left">{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2)}} s/ juros</small> --}}
                    </div>
                </div>
            </a>
        </div>
        @endforeach    
    </div>



</div>


@endsection