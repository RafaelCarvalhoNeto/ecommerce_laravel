@extends('layouts.appAdmin')
@section('title')
    ADM - Faturamento por Produtos
@endsection
@section('content')


    <main class="container pt-3 ajuste" id="barraPedidos">
        @if(session('success'))
        <section class="row">
            <div class="col-12">
                <div class="Message alert alert-success text-center">
                    {{ session('success')}}
                </div>
            </div>
        </section>
        @endif
        <div class="row">
            <h2 class="col-12 p-3 mb-3 border-bottom">Faturamento por Produto</h2>
            @if ($maisVendidos)
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por um Produto:</p>
                
                <form action="#" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="inputSearch" type="search" arial-label="search" placeholder="Pesquisar..." name='inputSearch'>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-search-adm" type="submit">Pesquisar</button>
                        </div>
                    </div>
                </form>
                <p class="col-md-4 m-0 mt-3 p-0 ml-auto text-right">Total de resultados encontrados: <strong>XX</strong></p>

                <div id="table"  class="tableAdm">
                    <table class="table table-striped text-center mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <!-- Por alguma razao as paginas Adm nao estao puxando codigo CSS entao inclui style individual em cada imagem -->
                                <th scope="col">ID</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço (BRL)</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Qtd Vendida</th>
                                <th scope="col">Fat Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $total=0;
                            @endphp
                            @foreach ($maisVendidos as $maisVendido)
                                <tr>
                                    <td scope="row">{{$maisVendido->id}}</td>
                                    <td scope="row">{{$maisVendido->nome}}</td>
                                    <td scope="row">R$ {{number_format($maisVendido->preco,2,',','.')}}</td>
                                    <td scope="row">{{$maisVendido->cat->tipo}}</td>
                                    <td scope="row">{{!empty($maisVendido->pedido_produtos[0]->qtd) ? ($maisVendido->pedido_produtos[0]->qtd) : 0}}</td>                   
                                    <td scope="row">R$ {{!empty($maisVendido->pedido_produtos[0]->valores)
                                    ? (number_format($maisVendido->pedido_produtos[0]->valores,2,',','.'))
                                    : 0}}</td>                   

                                </tr>
                                @php
                                    $valor = !empty($maisVendido->pedido_produtos[0]->valores)
                                    ? ($maisVendido->pedido_produtos[0]->valores)
                                    : 0;
                                    $total += $valor;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <p class="col-md-12 mt-3 border p-2 text-right font-weight-bold">R$ {{number_format($total,2,',','.')}}</p>
                    <div class="d-flex justify-content-center mt-4">
                        {{-- {{ $produtos->appends(['search' => isset($search) ? $search : ''])->links() }} --}}
                    </div>
                </div>


            </div>
                
            @else
            <div class="col-md-12 p-0 text-center">
                <div class="my-4 p-5 p-auto border ">
                    <h4 class="font-weight-bold">Seu carrinho está vazio</h4>
                    <a class="text-secondary" href="/">Volte para a página inicial</a>

                </div>
            </div>
            @endif
        </div>



        
       

    </main>


    {{-- <script>
        fats = document.querySelectorAll('teste')
        total = 0;
        // console.log(fats[1].innerText.replace(/([^\d])+/gim, ''))
        for (let fat of fats){
            console.log(  parseInt(fat.innerText.substr(3))   )
        }
        // console.log(total)
    </script> --}}

@endsection