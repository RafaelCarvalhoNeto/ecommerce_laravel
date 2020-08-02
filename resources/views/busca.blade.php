@extends('layouts.app')
@section('content')
    <div class="container pt-3 ajuste">

        <div class="row">
            <div class="col-md-2 col-sm-12">
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
                            <small class='inputRange'>R$ 1 -</small>
                            <small id="final-range" class='inputRange'>R$ {{$precoBuscado != null ?$precoBuscado:$maxPrice}}</small>
                            <input type="range" id="myRange" min='1' max='{{$maxPrice}}' value="{{$precoBuscado != null?$precoBuscado:$maxPrice}}" name='preco'>
                        </div>
                        {{-- <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Marca</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option3">
                            <label class="form-check-label">Asus</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="option4">
                            <label class="form-check-label">Sony</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="option5">
                            <label class="form-check-label">Microsoft</label>
                        </div> --}}
                     </div>
                     <div class="col-md-12 p-0 my-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Pesquisar</button>
                    </div>
                    
                </form>

            </div>
            <div class="col-md-10 col-sm-12">
                <div class="row">
                    <h2 class="col-12 pt-3  ">Busca por: {{$search}}</h2>
                    <p class="col-12 border-bottom pb-3 mb-3">Total de resultados encontrados: <strong>{{$found}}</strong></p>
                    @foreach ($produtos as $produto)
                    <div class="col-md-3 pb-1 pb-md-0 mb-3">
                        <a href="/detalheProduto/{{$produto->slug}}">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="{{ $produto->imagem != null ? asset($produto->imagem) : asset('img/null.png') }}" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">{{ $produto->nome }}</h3>
                                    <p class="card-text preco m-0">R$ {{number_format(($produto->preco),2,',','.')}}</p>
                                    <small class="text-left">{{$produto->parcelamento}}x de R$ {{number_format(($produto->preco)/($produto->parcelamento),2,',','.')}} s/ juros</small>
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