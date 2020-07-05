@extends('layouts.app')
@section('content')

    <main class="container ajuste">
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Editar Usuário</h1>
        <form action="/editUsuarios/{{$user->id}}" method="post" id="formCadastro">     
            @csrf
            {{ method_field('PUT')}}                   
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNome">Nome</label>
                <input type="text" class="form-control" aria-describedby="nomeCadastroHelp" id="inputNome" name="inputNome" value="{{$user->nome}}" required>
                <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputSobrenome">Sobrenome</label>
                <input type="text" class="form-control" aria-describedby="sobrenomeCadastroHelp" value="{{$user->sobrenome}}" id="inputSobrenome" value="{{$user->nome}} name="inputSobrenome" required>
            </div>
            </div>

            <div class="form-group">
            <label for="inputEndereco">Endereço</label>
            <input type="text" class="form-control"  aria-describedby="enderecoHelp" id="inputEndereco" name="inputEndereco" required>
            </div>
            
            <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCep">CEP</label>
                <input type="text" class="form-control" name="inputCep" required>
            </div>
            <div class="form-group col-md-7">
                <label for="inputCidade">Cidade</label>
                <input type="text" class="form-control" name="inputCidade" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputUF">UF</label>
                <select class="form-control" name="inputUF" id="inputUF" required>
                <option disabled="" selected="">UF</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" id="inputEmail" name="inputEmail" required>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputSenha">Senha</label>
                <input type="password" name="inputSenha" class="form-control" aria-describedby="senhaHelp" id="inputSenha" required> 
            </div>
            <div class="form-group col-md-6">
                <label for="inputConfirma">Confirma Senha</label>
                <input type="password" class="form-control" aria-describedby="ConfirmaHelp" id="inputConfirma" name="inputConfirma" required>
            </div>
            </div>

            <div class="form-group col-auto clearfix px-0">
            <button type="submit" class="btn btn-primary float-right ml-2" data-toggle="modal" data-target="#modalTeste">Editar</button>
            </div>

        </form> 

        @if(isset($success) && $success != "")
            <div class="alert alert-success text-center col-md-6">
                {{ $success }}
            </div>
        @endif



    </main>



@endsection