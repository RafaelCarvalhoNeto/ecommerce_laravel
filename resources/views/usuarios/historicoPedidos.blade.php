@extends('layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container pt-3 ajuste">
  <div class="row">
    <h2 class="col-12 p-3 mb-3 border-bottom">Informações Pessoais</h2>
    <div class="col-md-8">
      <h3>{{ Auth::user()->nome }} {{ Auth::user()->sobrenome }}</h3>
      <p class="m-0">{{ Auth::user()->email }}</p>
      <p class="m-0">{{ Auth::user()->endereco }}, {{ Auth::user()->cidade }}, {{ Auth::user()->uf}} | {{ Auth::user()->cep }}</p>
      <p>CPF: {{ Auth::user()->cpf }}</p>
      <a href='/usuarios/editUsuarios/{{ Auth::user()->id }}'>Editar perfil</a>
    </div>

    <div class="col-md-4 d-flex justify-content-center">
      <a href="#" data-toggle="modal" data-target="#modal-foto">
        <div class="rounded-foto text-center">
          <img class="foto-perfil-historico" src="{{ Auth::user()->foto != null ? asset(Auth::user()->foto) : asset('https://cdn2.vectorstock.com/i/thumb-large/23/81/default-avatar-profile-icon-vector-18942381.jpg') }}" width="150" gitalt="Imagem de Perfil">
          <div class="overlay">
            <div class="text">Editar Perfil</div>
          </div>
        </div>
        
      </a>
      <div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content  text-left">
            <div class="modal-header">
              <h5 class="modal-title">Editar o foto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="/usuarios/editarFoto/{{Auth::user()->id}}" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <label for="inputImagem">Foto</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="foto" lang="pt" name="foto">
                      <label class="custom-file-label" for="foto">Escolha a imagem</label>
                    </div>
                    <input type="hidden" name="fotoName" value={{Auth::user()->foto}}>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Editar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    

  </div>
  
  
  <main class="row" id="barraPedidos">

    <h2 class="col-12 p-3 mt-3 mb-3 border-bottom" id="caixaPedidos">Todos os Pedidos</h2>
    
    {{-- <div class="col-12 mt-3 mb-3">
      <p>Pesquise por um pedido:</p>  
      <input class="form-control" id="myInput" type="text" placeholder="Pesquisar...">
      <div id="table" class="tableCarrinho">
        @foreach ($pedidos as $pedido)
          <p>{{$pedido->id}}</p>
          @foreach ($pedido->pedido_produtos as $pedido_produto)
              
          <table class="table table-striped text-center mt-3">
            <thead class="thead-dark">
              <tr>
                <th scope="col">N<sup>o</sup> do Pedido</th>
                <th scope="col">Produto</th>
                <th scope="col">Data</th>
                <th scope="col">Pagamento</th>
                <th scope="col">Status</th>
                <th scope="col">NF-e</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <tr>
                <th scope="row">1</th>
                <td>Bolsa</td>
                <td>02/01/2020</td>
                <td>Boleto Bancario</td>
                <td>Enviado</td>
                <td><a href="#">pdf</a></td>
              </tr>
            </tbody>
          </table>
          @endforeach
        @endforeach
      </div>

    </div> --}}

    <!-- ACCORDION -->

    <div class="col-md-12 p-0">

      <div class="accordion" id="accordionTabsProduto">
        @forelse ($pedidos as $pedido)
        <div>
          <button class="acordeao text-left my-2 d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#titulo{{$pedido->id}}" aria-expanded="false" aria-controls="titulo{{$pedido->id}}">
            <p class="m-0">Pedido {{$pedido->id}}<i class="fas fa-chevron-down ml-3 font-weight-light"></i></p>
            <small class="m-0 font-weight-bold">{{$pedido->updated_at->format('d/m/Y H:i')}} - Status {{$pedido->status}}</small>
          </button>

          <div id="titulo{{$pedido->id}}" class="collapse" aria-labelledby="aba{{$pedido->id}}" data-parent="#accordionTabsProduto">
            <div class="card-body p-0">

              <div id="table" class="tableCarrinho">
                @php
                  $item = 1;
                @endphp
                  <table class="table table-striped text-center mt-3">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Qtd</th>
                        <th scope="col">nf</th>
                        <th scope="col">Valor</th>
                      </tr>
                    </thead>
                    @php
                      $total_pedido = 0;
                    @endphp
                    <tbody id="myTable">
                      @foreach ($pedido->pedido_produtos as $pedido_produto)
                      <tr>
                        <th scope="row">{{$item++}}</th>
                        <td>{{$pedido_produto->produto->nome}}</td>
                        <td>{{$pedido_produto->qtd}}</td>
                        <td><a href="#">pdf</a></td>
                        <td>R$ {{number_format($pedido_produto->valores, 2, ',','.')}}</td>
                      </tr>
                      @php
                        $total_pedido += $pedido_produto->valores;
                      @endphp
                      @endforeach
                        <tr class='table-dark'>
                          <td colspan="3"></td>
                          <td class="align-middle font-weight-bold">Total</td>
                          <td class="align-middle font-weight-bold">R$ {{number_format($total_pedido, 2, ',','.')}}</td>
                        </tr>
                    </tbody>
                  </table>
              </div>

            </div>
          </div>
        </div>
      @empty
        <div class="col-md-12 p-0 text-center">
          <div class="my-4 p-5 p-auto border ">
            <h4 class="font-weight-bold">Nenhuma compra foi realizada</h4>
            <a class="text-secondary" href="/">Explore nossa loja</a>
        </div>
      </div>
      @endforelse
      </div>
    </div>



  </main>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endsection