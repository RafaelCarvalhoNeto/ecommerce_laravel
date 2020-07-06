@extends('layouts.app')
@section('content')

    <main class="container ajuste">
        @if(isset($success) && $success != "")
            <section class="row">
                <div class="col-12">
                    <div class="message alert alert-success text-center">
                        {{ $success }}
                    </div>
                </div>
            </section>
        @endif
        <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Editar Usuário</h1>
        <form action="/editUsuarios/{{$user->id}}" method="post" id="formCadastro">     
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
                <option value="AC"
                {{$user->uf=='AC' ? 'selected':''}}
                >AC</option>
                <option value="AL"
                {{$user->uf==('AL') ? 'selected':''}}>AL</option>
                <option value="AM"
                {{$user->uf==('AM') ? 'selected':''}}>AM</option>
                <option value="AP"
                {{$user->uf==('AP') ? 'selected':''}}>AP</option>
                <option value="BA"
                {{$user->uf==('BA') ? 'selected':''}}>BA</option>
                <option value="CE"
                {{$user->uf==('CE') ? 'selected':''}}>CE</option>
                <option value="DF"
                {{$user->uf==('DF') ? 'selected':''}}>DF</option>
                <option value="ES"
                {{$user->uf==('ES') ? 'selected':''}}>ES</option>
                <option value="GO"
                {{$user->uf==('GO') ? 'selected':''}}>GO</option>
                <option value="MA"
                {{$user->uf==('MA') ? 'selected':''}}>MA</option>
                <option value="MG"
                {{$user->uf==('MG') ? 'selected':''}}>MG</option>
                <option value="MS"
                {{$user->uf==('MS') ? 'selected':''}}>MS</option>
                <option value="MT"
                {{$user->uf==('MT') ? 'selected':''}}>MT</option>
                <option value="PA"
                {{$user->uf==('PA') ? 'selected':''}}>PA</option>
                <option value="PB"
                {{$user->uf==('PB') ? 'selected':''}}>PB</option>
                <option value="PE"
                {{$user->uf==('PE') ? 'selected':''}}>PE</option>
                <option value="PI"
                {{$user->uf==('PI') ? 'selected':''}}>PI</option>
                <option value="PR">PR</option>
                {{$user->uf==('PR') ? 'selected':''}}
                <option value="RJ"
                {{$user->uf==('RJ') ? 'selected':''}}>RJ</option>
                <option value="RN"
                {{$user->uf==('RN') ? 'selected':''}}>RN</option>
                <option value="RO"
                {{$user->uf==('RO') ? 'selected':''}}>RO</option>
                <option value="RR"
                {{$user->uf==('RR') ? 'selected':''}}>RR</option>
                <option value="RS"
                {{$user->uf==('RS') ? 'selected':''}}>RS</option>
                <option value="SC"
                {{$user->uf==('SC') ? 'selected':''}}>SC</option>
                <option value="SE"
                {{$user->uf==('SE') ? 'selected':''}}>SE</option>
                <option value="SP"
                {{$user->uf==('SP') ? 'selected':''}}>SP</option>
                <option value="TO"
                {{$user->uf==('TO') ? 'selected':''}}>TO</option>
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