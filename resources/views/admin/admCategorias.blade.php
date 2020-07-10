@extends('layouts.appAdmin')
@section('content')

<main class="container pt-3 ajuste" id="barraPedidos">
    @if(isset($success) && $success != "")
    <section class="row">
        <div class="col-12">
            <div class="message alert alert-success text-center">
                {{ $success }}
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
                        <button class="btn btn-primary px-5" type="submit">Pesquisar</button>
                    </div>

                </div>
            </form>
            <div id="table" class="tableAdm">
                <table class="table table-striped text-center mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="row">ID</th>
                            <th scope="col">Categoria</th>
                            <th scope="col" colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td scope="row">{{ $categoria->id }}</td>
                            <td scope="row">{{ $categoria->categoria }}</td>
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
                            <h4>{{ $categoria->categoria }}</h4>
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
                            <form class="container" action="createCategoria" method="post" id="formCategoria">
                                @csrf
                                    {{ method_field('POST') }}
                                <div class="form-group">                 
                                    <input type="text" class="form-control" id="inputCategoria"
                                        aria-describedby="categoriaNova" placeholder="Insira uma nova categoria">
                                </div>
                                <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                                <form class='btn-block'action="/admin/createCategoria" method="POST" id=inputCategoria>
                                    @csrf
                                    {{ method_field('POST') }}
                                    <button id="create-categoria" type="submit" class="btn btn-primary btn-block">Adicionar</a>
                                </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection