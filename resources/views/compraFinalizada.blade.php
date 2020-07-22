@extends('layouts.app')
@section('title')
    Compra Finalizada
@endsection
@section('content')

    <section class="container jumbotron pt-0 mt-3 ajuste d-flex align-items-center justify-content-center">
        <div class="row ">
            <div class="col-md-12 text-center boxCheck">
                <p class='pedidoFinal m-0'><i class="fas fa-check-circle checkCompra d-block mb-2"></i>Pedido Finalizado com Sucesso!</p>
                <p class="font-weight-bold">O número do seu pedido é:</p>
                <p class="m-0">Obrigado por comprar na nossa loja</p>
                <p class="m-0">A cobrança desta compra foi enviada para sua operadora de cartão de crédito</p>
                <p class="m-0">Acompanhe aqui seu pedido:</p>
            </div>
            
        </div>
    </section>





@endsection