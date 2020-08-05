
@extends('layouts.appAdmin')
@section('title')
    ADM - Mensagens
@endsection
@section('content')

    <main class="container pt-3 ajuste" id="barraPedidos">
        @if(session('success'))
            <section class="row">
                <div class="col-12">
                    <div class="message alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                </div>
            </section>
        @endif
        <div class="row">
            <h2 class="col-12 p-3 mb-3 border-bottom">Mensagens</h2>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por uma Mensagem:</p>

                <form action="{{ url('/admin/admMensagens/search') }}" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="myInput" type="search" arial-label="search" placeholder="Pesquisar..." name='search'>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-search-adm" type="submit">Pesquisar</button>

                        </div>

                    </div>
                </form>
                <p class="col-md-4 m-0 mt-3 p-0 ml-auto text-right">Total de resultados encontrados: <strong>{{$found}}</strong></p>
                <div id="table" class="tableAdm">
                    <table class="table table-striped text-center mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Status</th>
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
                                <th scope="row">{{ $message->id }}</td>    
                                <td scope="row">
                                    <form action="/admin/toggleEmail/{{$message->id}}" method="post">
                                        @csrf
                                        {{ method_field('PUT')}} 
                                        @if ($message->status=='Não lido')
                                        <input type="hidden" name="status" value='Lido'>
                                        <button type='submit' class="btn btn-danger btn-sm">Não lido</button>
                                        
                                        @elseif($message->status=='Lido')
                                        <input type="hidden" name="status" value='Não lido'>
                                        <button type="submit" class="btn btn-success btn-sm">Lido</button>

                                        @else
                                        <button type="button" class="btn btn-primary btn-sm">Respondido</button>
                                        @endif
                                    </form>
                                </td>    
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

                                            <div id="carouselModal{{$message->id}}" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">

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
                                                                        <p>{{ $message->conteudo }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <a href="#carouselModal{{$message->id}}" role="button" class="btn btn-dark btn-block" data-slide="next">Responder</a>

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
                                                            <form method='post' action='/sendemail/send'>
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" name="inputAssunto" id="" value="{{$message->assunto}}">
                                                                    <input type="hidden" name="id" id="" value="{{$message->id}}">
                                                                    <div class="form-group">

                                                                        <label for="recipient-name" class="col-form-label">Destinatário:</label>
                                                                        <input type="text" readonly class="form-control" id="inputNome" name="inputNome" value="{{ $message->nome }} {{ $message->sobrenome }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                                                        <input type="email" readonly class="form-control" id="inputEmail" name="inputEmail" value="{{ $message->email }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="col-form-label">Mensagem:</label>
                                                                        <textarea class="form-control" id="message-text" rows="4" name="inputConteudo"></textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                                                                </div>
                                                            </form>
                                        
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

                                                    <h5 class="font-weight-bold">Messagem #ID{{ $message->id }}</h5>
                                                    <p>Assunto: {{$message->assunto}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                                                    <form class='btn-block'action="/admin/removeMessage/{{ $message->id }}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button id="delete-contact" type="submit" class="btn btn-danger btn-block">Excluir</a>

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

                <div class="d-flex justify-content-center mt-4">
                    {{ $messages->appends(['search'=>isset($search) ? $search:''])->links() }}
                </div>

            </div>
        </div>


            


    </main>

@endsection