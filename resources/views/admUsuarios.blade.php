@extends('layouts.app')
@section('content')

    <section class="jumbotron jumbotron-fluid py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex text-center flex-wrap">
                    <a href="painelAdm" class="mr-3 my-auto text-dark"><strong>Menu Administrativo</strong></a>
                    <a class="mr-3 my-auto" href="admCategorias">Categorias</a>
                    <a class="mr-3 my-auto" href="admMensagens">Mensagens</a>
                    <a class="mr-3 my-auto" href="admProdutos">Produtos</a>
                    <a class="mr-3 my-auto" href="admUsuarios">Usuarios</a>
                </div>
            </div>
        </div>
    </section>

    <main class="container ajuste" id="barraPedidos">
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
            <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Tabela de Usuários</h1>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por uma Usuário:</p>
                <form action="{{ url('/admUsuarios/search') }}" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="myInput" type="search" arial-label="search" placeholder="Pesquisar..." name='search'>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>

                    </div>
                </form>
                <div class="tableAdm">
                    <table class="table table-striped text-center mt-3 tableAdm">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col"> CPF</th>
                            <th scope="col">Email</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">CEP</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">UF</th>
                            <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td scope="row">{{$user->nome}}</td>
                                    <td scope="row">{{$user->sobrenome}}</td>
                                    <td scope="row">{{$user->cpf}}</td>
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">{{$user->endereco}}</td>
                                    <td scope="row">{{$user->cep}}</td>
                                    <td scope="row">{{$user->cidade}}</td>
                                    <td scope="row">{{$user->uf}}</td>
                                    <td scope="row">
                                        <a href="/editUsuarios/{{$user->id}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td scope="row">
                                        <a href="#" data-toggle="modal" data-target="#modal{{ $user->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <div class="modal fade" id="modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Deseja excluir o usuario?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <p>ID: {{ $user->id }}</p>
                                                        <p>Nome: {{ $user->nome }}</p>
                                                        <p>Sobrenome: {{ $user->sobrenome }}</p>
                                                        <p>Email: {{ $user->email }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form action="remove/{{ $user->id }}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button id="delete-contact" type="submit" class="btn btn-primary">Excluir</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->appends(['search' => isset($search) ? $search : ''])->links() }}
                    </div>
                </div>


            </div>
        </div>

    </main>

@endsection