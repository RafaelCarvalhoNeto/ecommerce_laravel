@extends('layouts.app')
@section('title')
    Finalizar compra
@endsection
@section('content')
    <section class="container my-3">
        <form action="{{route('pedido.concluido')}}" method="post" class="row">
            @csrf
            <article class="col-12 col-md-7" id="formularioPagamento">
                <div class="">
                    <h2 class="col-12 p-3 mb-3 border-bottom">Finalizando compra</h2>
                    <div class="col-md-12">
                        <p class="ml-0">Endereço de cobrança</p>
                        <h3>{{ Auth::user()->nome }} {{ Auth::user()->sobrenome }}</h3>
                        <p class="m-0">{{ Auth::user()->email }}</p>
                        <p class="m-0">{{ Auth::user()->endereco }}, {{ Auth::user()->cidade }}, {{ Auth::user()->uf}} | {{ Auth::user()->cep }}</p>
                        <p>CPF: {{ Auth::user()->cpf }}</p>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="enderecoEntregaIgualDeCobranca" id="enderecoEntregaIgualDeCobranca" checked="">
                            <label class="form-check-label" for="enderecoEntregaIgualDeCobranca" data-toggle="collapse" href="#enderecoEntrega" role="button" aria-expanded="false" aria-controls="enderecoEntrega">O endereço de entrega é o mesmo que o de cobrança</label>
                        </div>
                    </div>
                    <div id="enderecoEntrega" class="collapse col-md-12">
                        <h4>Endereço de Entrega</h4>
                        <p class="ml-0">Preencha o formulário formulário com os dados do endeço de entrega</p>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nomeDestinatario">Nome do Destinatário</label>
                                <input type="text" class="form-control" name="nomeDestinatario" id="nomeDestinatario" placeholder="Nome de quem vai receber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailDestinatario">email do Destinatário</label>
                                <input type="email" class="form-control" name="emailDestinatario" id="emailDestinatario" placeholder="email@destinatario.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cepDestinatario">CEP</label>
                                <input type="text" class="form-control" name="cepDestinatario" id="cepDestinatario" placeholder="01234-567">
                            </div>
                            <div class="form-group col-md-7">
                                <label for="cidadeDestinatario">Cidade</label>
                                <input type="text" class="form-control" name="cidadeDestinatario" id="cidadeDestinatario" placeholder="São Paulo">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ufDestinatario">UF</label>
                                <select class="form-control" name="uf" id="uf">
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
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="logradouroDestinatario">Endereço</label>
                                <input type="text" class="form-control" name="logradouroDestinatario" id="logradouroDestinatario" placeholder="Av. Brasil">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="numeroDestinatario">Número</label>
                                <input type="text" class="form-control" name="numeroDestinatario" id="numeroDestinatario" placeholder="123-A">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="complementoDestinatario">Complemento</label>
                                <input type="text" class="form-control" name="complementoDestinatario" id="complementoDestinatario" placeholder="Apto. 420">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observacaoEntrega">Nota de Entrega</label>
                            <textarea class="form-control" name="observacaoEntrega" id="observacaoEntrega" rows="3" aria-describedby="#observacaoEntregaHelp"></textarea>
                            <small id="observacaoEntregaHelp" class="form-text text-muted">Se houver alguma observação, inclua nesse campo (ex.: deixar na portaria).</small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="dados-pedido col-12 col-md-5 jumbotron p-0 pb-3" id="dadosPedido">
                <div class="">
                    <h2 class="col-12 p-3 mb-3 border-bottom">Dados do pedido</h2>
                    <div class="col-md-12">
                        <p class="ml-0">Confirmação do Pedido</p>
                        <ul class="dadosPedido">
                            @foreach ($pedidos as $pedido)
                                @php
                                    $total_pedido = 0;
                                    $total_produtos = 0;
                                    $total_descontos = 0;
                                @endphp
                                @foreach ($pedido->pedido_produtos as $pedido_produto)
                                    <li class="row">
                                        <div class="col-9 d-flex align-items-center">
                                            <p class="mb-0 flex-grow-1 "><strong class="checkout-qtd">{{$pedido_produto->qtd}} X</strong> {{$pedido_produto->produto->nome}}
                                        </div>
                                        <div class="col-3 text-right d-flex align-items-center">
                                            <p class="mb-0 flex-grow-1">R$ {{number_format($pedido_produto->valores,2,',','.')}}</p>
                                        </div>
                                    </li>
                                    <hr class="my-2 text-muted">
                                    
                                    @php
                                        $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                                        $total_pedido += $total_produto;
                                        $total_produtos += $total_produto;
                                        $total_descontos += $pedido_produto->descontos;
                                    @endphp
                                @endforeach

                                <li class="row">
                                    <div class="col-9 d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 ">Subtotal</p>
                                    </div>
                                    <div class="col-3 text-right d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1">R$ {{number_format($total_produtos, 2, ',','.')}}</p>
                                    </div>
                                </li>
                                <li class="row">

                                    <div class="col-9 d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 ">Desconto</p>
                                    </div>
                                    <div class="col-3 text-right d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 text-info">R$ {{number_format($total_descontos, 2, ',','.')}}</p>
                                    </div>

                                </li>
                                <li class="row">

                                    <div class="col-9 d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 ">Frete</p>
                                    </div>
                                    <div class="col-3 text-right d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1">R$ 0,00</p>
                                    </div> 
                                    
                                </li>
                                <li>
                                    <small class="text-muted mt-0">Prazo de Entrega: até 5 dias úteis</small>
                                </li>
                                <hr class="text-mute my-2">
                                <li class="row">

                                    <div class="col-8 d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 checkout-total">Total</p>
                                    </div>
                                    <div class="col-4 text-right d-flex align-items-center">
                                        <p class="mb-0 flex-grow-1 checkout-total-price">R$ {{number_format($total_pedido, 2, ',','.')}}</p>
                                    </div> 
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <h2 class="col-12 p-3 mb-3 border-bottom">Dados de pagamento</h2>
                    <div class="col-md-12">

                        <p class="ml-0">Preencha os dados de pagamento a seguir</p>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="nomeTitular">Nome do Titular do Cartão</label>
                                <input type="text" class="form-control bg-white" name="nomeTitular" id="nomeTitular" placeholder="Nome Completo" aria-describedby="#nomeTitularHelp">
                                <small id="nomeTitularHelp" class="form-text text-muted">Digite o nome exatamente como está no cartão</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="numeroCartao">Número do Cartão</label>
                                <input type="text" class="form-control bg-white" name="numeroCartao" id="numeroCartao" placeholder="1234 5678 9012 3456" >
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cvcCartao">Cód.</label>
                                <input type="text" class="form-control bg-white" name="cvcCartao" id="cvcCartao" placeholder="123">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vencimentoCartao">Vencimento</label>
                                <input type="month" class="form-control bg-white" name="vencimentoCartao" id="vencimentoCartao" placeholder="123">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                            <button type="submit" class="btn btn-primary btn-block">Confirmar Pagamento</i></button>
                        </div>

                    </div>

                </div>
            </article>
        </form>
    </section>

            
    {{-- <script>
    // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
        var forms = document.getElementsByClassName('needs-validation');
        // Faz um loop neles e evita o envio
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
    </script> --}}

@endsection