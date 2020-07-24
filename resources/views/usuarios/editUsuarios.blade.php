@extends('layouts.app')
@section('content')

    <main class="container pt-3 ajuste">
        @if(isset($success) && $success != "")
            <section class="row">
                <div class="col-12">
                    <div class="message alert alert-success text-center">
                        {{ $success }}
                    </div>
                </div>
            </section>
        @endif
        <h2 class="col-12 p-3 mb-3 border-bottom">Editar Usuário</h1>
        <form action="/usuarios/editUsuarios/{{$user->id}}" method="post" id="formCadastro" enctype="multipart/form-data">     
            @csrf
            {{ method_field('PUT')}}                         
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNome">Nome</label>
                <input type="text" class="form-control" aria-describedby="nomeCadastroHelp" id="inputNome" name="inputNome" value="{{$user->nome}}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputSobrenome">Sobrenome</label>
                <input type="text" class="form-control" placeholder="Insira seu sobrenome" aria-describedby="sobrenomeCadastroHelp" id="inputSobrenome" name="inputSobrenome" value="{{$user->sobrenome}}" required>
            </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCPF">CPF</label>
                    <input type="number" class="form-control" placeholder="Insira seu CPF" aria-describedby="CPFCadastroHelp" id="inputCPF" name="inputCPF" value="{{$user->cpf}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputRG">RG</label>
                    <input type="number" class="form-control" placeholder="Insira seu RG" aria-describedby="RGCadastroHelp" id="inputRG" name="inputRG" value="{{$user->rg}}" required>
                </div>
                </div>
            <div class="form-group">
            <label for="inputEndereco">Endereço</label>
            <input type="text" class="form-control" placeholder="Insira seu endereço" aria-describedby="enderecoHelp" id="inputEndereco" name="inputEndereco" value="{{$user->endereco}}" required>
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
            <input type="email" class="form-control" placeholder="Insira seu email" aria-describedby="emailHelp" id="inputEmail" name="inputEmail" value="{{$user->email}}" required>
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

            <div class="form-group col-auto clearfix px-0">
            <button type="submit" class="btn btn-primary float-right ml-2" data-toggle="modal" data-target="#modalTeste">Editar</button>
            </div>

        </form> 


    </main>










@endsection