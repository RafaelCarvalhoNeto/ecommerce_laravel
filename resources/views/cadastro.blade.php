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
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Cadastro</h1>
        <form action="cadastro" method="post" id="formCadastro" name="formCadastro" onsubmit="return validarForm();">
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
                    <input type="number" class="form-control{{$errors->has('inputCPF') ? ' is-invalid':''}}" placeholder="Insira seu CPF" aria-describedby="CPFCadastroHelp" id="inputCPF" name="inputCPF" value="{{ old('inputCPF') }}"  onblur="validarCpf()" required>
                    <div class="form-erro" id="erroCpf">O campo CPF deve conter 11 numeros</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputRG">RG</label>
                    <input type="number" class="form-control{{$errors->has('inputRG') ? ' is-invalid':''}}" placeholder="Insira seu RG" aria-describedby="RGCadastroHelp" id="inputRG" name="inputRG" value="{{ old('inputRG') }}" onblur="validarRg()" required>
                    <div class="form-erro" id="erroRg">O campo RG deve conter 9 numeros</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEndereco">Endereço</label>
                <input type="text" class="form-control{{$errors->has('inputEndereco') ? ' is-invalid':''}}" placeholder="Insira seu endereço" aria-describedby="enderecoHelp" id="inputEndereco" name="inputEndereco" value="{{ old('inputEndereco') }}" required>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputCep">CEP</label>
                    <input type="text" class="form-control{{$errors->has('inputCep') ? ' is-invalid':''}}" placeholder="01234-567" id="inputCep" name="inputCep" value="{{ old('inputCep') }}" required>
                </div>
                <div class="form-group col-md-7">
                    <label for="inputCidade">Cidade</label>
                    <input type="text" class="form-control{{$errors->has('inputCidade') ? ' is-invalid':''}}" placeholder="São Paulo" name="inputCidade" value="{{ old('inputCidade') }}" id="inputCidade" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputUF">UF</label>
                    <select class="form-control" name="inputUF" id="inputUF" required>
                    <option disabled selected>UF</option>
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
                <input type="email" class="form-control{{$errors->has('inputEmail') ? ' is-invalid':''}}" placeholder="Insira seu email" aria-describedby="emailHelp" id="inputEmail" name="inputEmail" value="{{ old('inputEmail') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputSenha">Senha</label>
                    <input type="password" name="inputSenha" class="form-control{{$errors->has('inputSenha') ? ' is-invalid':''}}" placeholder="Senha" aria-describedby="senhaHelp" id="inputSenha" onblur="validarSenha()" required> 
                    <div class="invalid-feedback">{{ $errors->first('inputSenha') }}</div>
                    <sub class="" id="senhaAlphaNum">A senha deve incluir no mínimo 6 caracteres, um número, uma maiúscula, uma minúscula e não conter espaço</sub>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputConfirma">Confirma Senha</label>
                    <input type="password" class="form-control{{$errors->has('inputConfirma') ? ' is-invalid':''}}" placeholder="Confirma senha" aria-describedby="ConfirmaHelp" id="inputConfirma" name="inputConfirma" required>
                    <div class="invalid-feedback">{{ $errors->first('inputConfirma') }}</div>
                </div>
            </div>

            <div class="form-group form-check pb-3">
                <input type="checkbox" class="form-check-input" id="aceite" required>
                <label class="form-check-label" for="aceite">Concordo com a <a href="politicas">Políticas de Privacidade</a> e <a href="politicas">Termos de Uso</a></label>
            </div>

            <div class="form-group col-auto px-0">
                <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTeste" id="btnEnviar" name="btnEnviar">Cadastrar</button>
                <div class="form-erro" id="erroForm">Alguns campos foram indevidamente preenchidos</div>
            </div>
        </form>


    </main>
    
    <script src="/js/validar-cadastro.js"></script>


@endsection