@extends('layouts.app')
@section('content')

    <section class="jumbotron jumbotron-fluid py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex text-center flex-wrap">
                    <p class="mr-3 my-auto"><strong>Menu Administrativo (Provisório)</strong></p>
                    <a class="mr-3 my-auto" href="admCategorias.php">Categorias</a>
                    <a class="mr-3 my-auto" href="admMensagens.php">Mensagens</a>
                    <a class="mr-3 my-auto" href="admProdutos.php">Produtos</a>
                    <a class="mr-3 my-auto" href="admUsuarios.php">Usuarios</a>
                </div>
            </div>
        </div>
    </section>

    <main class="container ajuste" id="barraPedidos">
        
        <div class="row">
            <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Tabela de Usuários</h1>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por uma Usuário:</p>
                <input class="form-control" id="myInput" type="text" placeholder="Pesquisar...">
                <div class="tableAdm">
                    <table class="table table-striped text-center mt-3 tableAdm">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col"> CPF</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
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
                                    <td scope="row">{{$user->senha}}</td>
                                    <td scope="row">{{$user->cep}}</td>
                                    <td scope="row">{{$user->cidade}}</td>
                                    <td scope="row">{{$user->uf}}</td>
                                    <td scope="row">
                                        <a href="/editUsuarios/{{$user->id}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td scope="row">
                                        <a href="#" data-toggle="modal" data-target="#modal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>

                </div>


            </div>
        </div>

    </main>

@endsection