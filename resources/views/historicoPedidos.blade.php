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
      <a href='/editUsuarios/{{ Auth::user()->id }}'>Editar perfil</a>
    </div>

    <div class="col-md-4">
      <div class="rounded-circle text-center">
        <img src="https://cdn2.vectorstock.com/i/thumb-large/23/81/default-avatar-profile-icon-vector-18942381.jpg" width="150" alt="Imagem de Perfil">
      </div>
    </div>

  </div>
  
  <!-- Quando Comercarmos a editar esta pagina no backend porfavor substituir os codigos abaixo por variaveis -->


  <main class="row" id="barraPedidos">

    <h2 class="col-12 p-3 mt-3 mb-3 border-bottom" id="caixaPedidos">Todos os Pedidos</h2>
    
    <div class="col-12 mt-3 mb-3">
      <p>Pesquise por um pedido:</p>  
      <input class="form-control" id="myInput" type="text" placeholder="Pesquisar...">
      <div id="table">
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
            <tr>
              <th scope="row">2</th>
              <td>Computador</td>
              <td>02/01/2020</td>
              <td>Cartao de Credito</td>
              <td>Entregue</td>
              <td><a href="#">pdf</a></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Livro</td>
              <td>02/01/2020</td>
              <td>Paypal</td>
              <td>Entregue</td>
              <td><a href="#">pdf</a></td>
            </tr>
          </tbody>
        </table>
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