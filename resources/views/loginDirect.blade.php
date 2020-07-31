@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')

    <section class="container mt-3 ajuste">
        <div class="row ">
            <div class="col-md-6">
                <h2 class="col-12 p-3 mb-3 border-bottom">Login</h2>
                <form action="{{ route('login.do') }}" method="POST">
                    <div class="modal-body">
                      @csrf
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="meuemail@meuprovedor.com" name="email">
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="insira sua senha" name="password">
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="modal-footer">
                      {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button> --}}
                      <button type="submit" class="btn btn-primary btn-block">Logar</button>
                    </div>
                  </form>
                <label class="container justify-content-right mb-4">Esqueceu sua senha? <a href="#"><small>Clique Aqui!</small></a></label>   
            </div>

            <div class="col-md-6">
                <h2 class="col-12 p-3 mb-3 border-bottom">Cadastre-se</h2>
                <p class="mt-1 p-3">Ao criar uma conta na nossa loja, você será capaz de se mover através do processo de compra mais rapidamente, armazenar múltiplos endereços de envio, ver e rastrear seus pedidos em sua conta e muito mais.<br>
                O cadastro leva apenas alguns segundos.
                </p>
                <a class="p-3" href="/cadastro">Clique aqui para se cadastrar.</a>
            </div>
            
        </div>
    </section>





@endsection