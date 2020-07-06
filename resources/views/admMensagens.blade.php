@extends('layouts.app')
@section('content')

    <section class="jumbotron jumbotron-fluid py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex text-center flex-wrap">
                    <p class="mr-3 my-auto"><strong>Menu Administrativo</strong></p>
                    <a class="mr-3 my-auto" href="admCategorias">Categorias</a>
                    <a class="mr-3 my-auto" href="admMensagens">Mensagens</a>
                    <a class="mr-3 my-auto" href="admProdutos">Produtos</a>
                    <a class="mr-3 my-auto" href="admUsuarios">Usuarios</a>
                </div>
            </div>
        </div>
    </section>
    <main class="container pt-3 ajuste" id="barraPedidos">
        @if(isset($success) && $success != "")
            <section class="row">
                <div class="col-12">
                    <div class="message alert alert-success text-center">
                        {{ $success }}
                    </div>
                </div>
            </section>
        @endif
        <div class="row">
            <h2 class="col-12 p-3 mb-3 border-bottom">Mensagens</h2>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por uma Mensagem:</p>
                <form action="#" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="myInput" type="search" arial-label="search" placeholder="Pesquisar..." name='search'>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>

                    </div>
                </form>
                <div id="table" class="tableAdm">
                    <table class="table table-striped text-center mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Assunto</th>
                                <th scope="col" colspan="2">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                                <td scope="row">{{ $message->id }}</td>    
                                <td scope="row">{{ $message->nome }}</td>
                                <td scope="row">{{ $message->sobrenome }}</td>
                                <td scope="row">{{ $message->email }}</td>
                                <td scope="row">{{ $message->assunto }}</td>
                                <td scope="row">
                                    <a href="#" data-toggle="modal" data-target="#modalAbrir{{ $message->id }}">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <!-- Modal Abrir -->
                                    <div class="modal fade text-left" id="modalAbrir{{ $message->id }}" role="dialog" tabindex="-1"  aria-labelledby="modalMessageLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">

                                            <div id="carouselModal" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">

                                                <div class="carousel-inner">

                                                    <div class="carousel-item active" id="carrosselMessageItem">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalMessageLabel">Messagem #ID{{ $message->id }} | {{$message->assunto}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h5>Nome</h5>
                                                                        <p>{{ $message->nome }} {{ $message->sobrenome }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h5>E-mail</h5>
                                                                        <p>{{ $message->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>Assunto</h5>
                                                                        <p>{{ $message->assunto }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>Mensagem</h5>
                                                                        <p class=>{{ $message->conteudo }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="form-group col-auto clearfix px-0">
                                                                    <a href="#carouselModal" role="button" class="btn btn-dark float-right ml-2" data-slide="next">Responder</a>
                                                                </div>
                                                            </div>
                                        
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item" id="carroselSendItem">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalSentLabel">Enviar Messagem #ID{{ $message->id }} | {{$message->assunto}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                                        <input type="text" class="form-control" id="recipient-name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                                        <textarea class="form-control" id="message-text"></textarea>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Send message</button>
                                                            </div>
                                        
                                                        </div>
                                                    </div>


                                                </div>
                                                

                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td scope="row">
                                    <a href="#" data-toggle="modal" data-target="#modalExcluir{{ $message->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>                              
                                    <!-- Modal Excluir -->
                                    <div class="modal fade text-left" id="modalExcluir{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Deseja realmente excluir?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="font-weight-bold">Messagem #ID{{ $message->id }} | {{$message->assunto}}</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <form action="/removeMessage/{{ $message->id }}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button id="delete-contact" type="submit" class="btn btn-primary">Excluir</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>          
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


            


    </main>

@endsection