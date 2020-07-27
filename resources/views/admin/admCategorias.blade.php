
@extends('layouts.appAdmin')
@section('title')
    ADM - Categorias
@endsection
@section('content')

<main class="container pt-3 ajuste" id="barraPedidos">
    @if(session('success'))
    <section class="row">
        <div class="col-12">
            <div class="message alert alert-success text-center">
                {{ session('success') }}
            </div>
        </div>
    </section>
    @endif
    <div class="row">

        <h2 class="col-12 p-3 mb-3 border-bottom">Categorias</h2>
        <div class="col-12 mt-3 mb-3">
            <p>Pesquise por uma Categoria:</p>
            <form action="{{ url('/admin/admCategorias/search') }}" method="GET">
                <div class="input-group col-12 px-0">
                    <input class="form-control border-0" id="myInput" type="search" arial-label="search"
                        placeholder="Pesquisar..." name='search'>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-search-adm" type="submit">Pesquisar</button>
                    </div>

                </div>
            </form>
            <p class="col-md-4 m-0 mt-3 p-0 ml-auto text-right">Total de resultados encontrados: <strong>{{$found}}</strong></p>
            <div id="table" class="tableAdm">
                <table class="table table-striped text-center mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="row">ID</th>
                            <th class='imagem' scope="row">Banner</th>
                            <th scope="col">Categoria</th>
                            <th scope="col" colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <th scope="row">{{ $categoria->id }}</td>
                            <td scope="row"><img src="{{ $categoria->banner != null ? asset($categoria->banner) : asset('img/null.png') }}" alt="" width="50" height="50"></td>
                            <td scope="row">{{ $categoria->tipo }}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal2{{ $categoria->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Modal Editar -->
                                <div class="modal fade" id="modal2{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content  text-left">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar o categoria?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="/admin/admCategorias/update/{{$categoria->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="inputImagem">Banner</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="banner" lang="pt" name="banner">
                                                                <label class="custom-file-label" for="banner">Escolha a imagem</label>
                                                            </div>
                                                            <input type="hidden" name="bannerName" value={{$categoria->banner}}>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <label for="inputProduto">Categoria</label>
                                                            <input type="text" class="form-control" id="inputCategoria" name="inputCategoria" value="{{$categoria->tipo}}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">Editar</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td scope="row">
                                <a href="#" data-toggle="modal" data-target="#modalExcluir{{ $categoria->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="font-weight-bold">Adicionar Categoria
                    <a href="#" data-toggle="modal" data-target="#modalAdd">
                        <i class="far fa-plus-square"></i>
                    </a></p>
                
                <!-- Modal Excluir -->
                @foreach ($categorias as $categoria)
                <div class="modal fade" id="modalExcluir{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Deseja realmente excluir?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <h4>{{ $categoria->tipo }}</h4>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                                <form class='btn-block'action="/admin/removeCategoria/{{ $categoria->id }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button id="delete-categoria" type="submit" class="btn btn-danger btn-block">Excluir</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Modal Adicionar -->
                <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicione uma categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div><br>
                            <form class="container" action="/admin/admCategorias" method="post" id="formCategoria" enctype="multipart/form-data">
                                @csrf
                                    {{ method_field('POST') }}
                                <div class="form-group">                 
                                    <input type="text" class="form-control" id="inputCategoria" name="inputCategoria" aria-describedby="categoriaNova" placeholder="Insira uma nova categoria">
                                </div>
                                <div class="form-group">                 
                                    <input type="file" class="form-control" id="banner" name="banner" aria-describedby="categoriaNova" placeholder="Insira uma nova categoria">
                                </div>
                                <div class="modal-footer">
                                    <button id="create-categoria" type="submit" class="btn btn-primary btn-block">Adicionar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $categorias->appends(['search' => isset($search) ? $search : ''])->links() }}
            </div>
        </div>
    </div>
</main>

@endsection