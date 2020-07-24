@extends('layouts.appAdmin')
@section('title')
    ADM - Usuários
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
            <h2 class="col-12 p-3 mb-3 border-bottom">Usuários</h1>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por um Usuário:</p>
                <form action="{{ url('/admin/admUsuarios/search') }}" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="myInput" type="search" arial-label="search" placeholder="Pesquisar..." name='search'>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-search-adm" type="submit">Pesquisar</button>
                        </div>

                    </div>
                </form>
                <p class="col-md-4 m-0 mt-3 p-0 ml-auto text-right">Total de resultados encontrados: <strong>{{$found}}</strong></p>
                <div class="tableAdm">
                    <table class="table table-striped text-center mt-3 tableAdm">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col"> CPF</th>
                            <th scope="col">Email</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">UF</th>
                            <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td scope="row">
                                        <form action="/admin/toggleAdmin/{{$user->id}}" method="post">
                                            @csrf
                                            {{ method_field('PUT')}} 
                                            @if ($user->admin==null||$user->admin==0)
                                            <input type="hidden" name="admin" value='1'>
                                            <button type='submit' class="btn btn-success btn-sm">Tornar Admin</button>
                                            
                                            @else
                                            <input type="hidden" name="admin" value='0'>
                                            <button type="submit" class="btn btn-danger btn-sm">Retirar Admin</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td scope="row">{{$user->nome}}</td>
                                    <td scope="row">{{$user->sobrenome}}</td>
                                    <td scope="row">{{$user->cpf}}</td>
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">{{$user->cidade}}</td>
                                    <td scope="row">{{$user->uf}}</td>
                                    <td scope="row">
                                        <a href="#" data-toggle="modal" data-target="#modalEdit{{ $user->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="modal fade text-left" id="modalEdit{{ $user->id }}" role="dialog" tabindex="-1"  aria-labelledby="modalEditLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditLabel">Editar usuário #ID{{ $user->id }}</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>
                                                    <form action="/usuarios/editUsuarios/{{$user->id}}" method="post">
                                                    @csrf
                                                    {{ method_field('PUT')}} 
                                                        <div class="modal-body">

                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputNome">Nome</label>
                                                                    <input type="text" class="form-control" id="inputNome" name="inputNome" value="{{$user->nome}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputSobrenome">Sobrenome</label>
                                                                    <input type="text" class="form-control" placeholder="Insira seu sobrenome" id="inputSobrenome" name="inputSobrenome" value="{{$user->sobrenome}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputCPF">CPF</label>
                                                                    <input type="number" class="form-control" placeholder="Insira seu CPF"  id="inputCPF" name="inputCPF" value="{{$user->cpf}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputRG">RG</label>
                                                                    <input type="number" class="form-control" placeholder="Insira seu RG"  id="inputRG" name="inputRG" value="{{$user->rg}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputEndereco">Endereço</label>
                                                                <input type="text" class="form-control" placeholder="Insira seu endereço"  id="inputEndereco" name="inputEndereco" value="{{$user->endereco}}" required>
                                                            </div>
                                                                
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label for="inputCep">CEP</label>
                                                                    <input type="text" class="form-control" placeholder="01234-567" name="inputCep" value="{{$user->cep}}" required>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label for="inputCidade">Cidade</label>
                                                                    <input type="text" class="form-control" placeholder="São Paulo" name="inputCidade" value="{{$user->cidade}}" required>
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="inputUF">UF</label>
                                                                    <select class="form-control" name="inputUF" id="inputUF" required>
                                                                    <option disabled>UF</option>
                                                                        @foreach ($estados as $estado)
                                                                            <option value="{{$estado}}"
                                                                            {{$user->uf==$estado ? 'selected':''}}
                                                                            >{{$estado}}</option>
                                                                        
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="form-group">
                                                                <label for="inputEmail">Email</label>
                                                                <input type="email" class="form-control" placeholder="Insira seu email"  id="inputEmail" name="inputEmail" value="{{$user->email}}" required>
                                                            </div>
                                                    
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputSenha">Senha</label>
                                                                    <input type="password" name="inputSenha" class="form-control{{$errors->has('inputSenha') ? ' is-invalid':''}}" placeholder="Senha" aria-describedby="senhaHelp" id="inputSenha">
                                                                    <div class="invalid-feedback">{{ $errors->first('inputSenha') }}</div> 
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputConfirma">Confirma Senha</label>
                                                                    <input type="password" class="form-control{{$errors->has('inputConfirma') ? ' is-invalid':''}}" placeholder="Confirma senha" aria-describedby="ConfirmaHelp" id="inputConfirma" name="inputConfirma">
                                                                    <div class="invalid-feedback">{{ $errors->first('inputConfirma') }}</div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-dark btn-block">Editar</a>
                                                        </div>
                                                    </form>
                                
                                                </div>

                                            </div>
                                        </div>
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

                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                                                        <form class="btn-block"action="/admin/remove/{{ $user->id }}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button id="delete-contact" type="submit" class="btn btn-danger btn-block">Excluir</a>

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
                    
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->appends(['search' => isset($search) ? $search : ''])->links() }}
                </div>


            </div>
        </div>

    </main>

@endsection