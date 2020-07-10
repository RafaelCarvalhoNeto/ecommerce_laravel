@extends('layouts.appAdmin')
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
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Cadastro</h1>
        <form action="/admin/cadastroAdms" method="post" id="formCadastro">
            @csrf
            {{ method_field('POST') }}                        
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNome">Nome</label>
                <input type="text" class="form-control{{$errors->has('inputNome') ? ' is-invalid':''}}" placeholder="Insira seu nome" aria-describedby="nomeCadastroHelp" id="inputNome" name="inputNome" value="{{ old('inputNome') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputSobrenome">Sobrenome</label>
                <input type="text" class="form-control{{$errors->has('inputSobrenome') ? ' is-invalid':''}}" placeholder="Insira seu sobrenome" aria-describedby="sobrenomeCadastroHelp" id="inputSobrenome" name="inputSobrenome" value="{{ old('inputSobrenome') }}" required>
            </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCPF">CPF</label>
                    <input type="number" class="form-control{{$errors->has('inputCPF') ? ' is-invalid':''}}" placeholder="Insira seu CPF" aria-describedby="CPFCadastroHelp" id="inputCPF" name="inputCPF" value="{{ old('inputCPF') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control{{$errors->has('inputEmail') ? ' is-invalid':''}}" placeholder="Insira seu email" aria-describedby="emailHelp" id="inputEmail" name="inputEmail" value="{{ old('inputEmail') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputSenha">Senha</label>
                    <input type="password" name="inputSenha" class="form-control{{$errors->has('inputSenha') ? ' is-invalid':''}}" placeholder="Senha" aria-describedby="senhaHelp" id="inputSenha" required> 
                    <div class="invalid-feedback">{{ $errors->first('inputSenha') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputConfirma">Confirma Senha</label>
                    <input type="password" class="form-control{{$errors->has('inputConfirma') ? ' is-invalid':''}}" placeholder="Confirma senha" aria-describedby="ConfirmaHelp" id="inputConfirma" name="inputConfirma" required>
                    <div class="invalid-feedback">{{ $errors->first('inputConfirma') }}</div>
                </div>
            </div>
            <div class="form-group col-auto px-0">
                <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTeste">Cadastrar</button>
                {{-- <button type="reset" class="btn btn-secondary float-right">Limpar</button> --}}
            </div>

        </form>


    </main>










@endsection