@extends('layouts.app')
@section('title')
    Busca
@endsection
@section('content')
    <div class="container pt-3 ajuste">

        <div class="row">
            <div class="col-lg-2 col-sm-12">
                <form action="{{ url('/search') }}" method="GET">
                    <input type="hidden" value='{{$search}}' name='search'>
                    {{-- <h2 class="col-12 p-3 mb-3 border-bottom">Ofertas</h2>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="option1">
                        <label class="form-check-label">Promoção</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="option2">
                        <label class="form-check-label">Desconto</label>
                    </div> --}}
                    <div class="list-group">
                        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Preço</h2>
                        <div class="slidecontainer text-center">
                            <div>
                                <small class='inputRange'>R$ {{$minPrice}} -</small>
                                <small id="final-range" class='inputRange'>R$ {{$precoBuscado != null ?$precoBuscado:number_format($maxPrice,2,',','.')}}</small>

                            </div>
                            <input type="range" id="myRange" min='{{$minPrice}}' max='{{$maxPrice}}' value="{{$precoBuscado != null?$precoBuscado:$maxPrice}}" name='preco'>
                        </div>
                        <button class="navbar-toggler acordeao" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <small>Busca Avançada <i class="fas fa-chevron-down ml-3 font-weight-light"></i></small>
                        </button>
                        <div class="collapse {{ isset($_GET['informacoes'])? 'show': ''}}" id="navbarSupportedContent">
                            @php
                                $c = 0;
                                $w=0;
                            @endphp
                            @foreach ($lista as $titulo => $conteudo)
                            <p class="col-12 p-1 mt-3 mb-1 border-bottom  font-weight-bold">{{$titulo}}</p>
                                @foreach ($conteudo as $conteudo)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="informacoes" value="{{$conteudo}}" {{$req->informacoes == $conteudo &&  $req->informacoes != ''? 'checked':''}}>
                                        <label class="form-check-label">{{$conteudo}}</label>
                                    </div> 
                                    @php
                                        $w++;
                                    @endphp
                                @endforeach
                                @php
                                $c++;
                                if($c == 5){
                                    break;
                                }
                            @endphp
                            @endforeach
                        </div>
                    </div>
                     <div class="col-md-12 p-0 my-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Pesquisar</button>
                    </div>
                    
                </form>

            </div>
            <div class="col-lg-10 col-sm-12">
                <div class="row">
                    <h2 class="col-12 pt-3  ">Busca por: {{$search}}</h2>
                    <p class="col-12 border-bottom pb-3 mb-3">Total de resultados encontrados: <strong>{{$found}}</strong></p>
                    @foreach ($produtos as $produto)
                    <div class="col-lg-3 col-md-4 pb-1 pb-md-0 mb-3">
                        <a href="/detalheProduto/{{$produto->slug}}">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="{{ $produto->imagem != null ? asset($produto->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">{{ $produto->nome }}</h3>
                                    <p class="card-text preco m-0">R$ {{number_format(($produto->precoFinal),2,',','.')}}</p>
                                    <small class="text-left">{{$produto->parcelamento}}x de R$ {{number_format(($produto->precoFinal)/($produto->parcelamento),2,',','.')}} s/ juros</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
    
                   
                </div>
                    

            </div>
            

        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $produtos->appends([
                'search'=>isset($search) ? $search:'',
                'preco'=>isset($precoBuscado) ? $precoBuscado:'',
                
                ])->links() }}
        </div>

        

    </div>

    <script>
        var range = document.getElementById('myRange');
        var textRange = document.getElementById('final-range');
        range.addEventListener('change', function(){
            textRange.innerText = `R$ ${range.value}`;
        })
    </script>


@endsection