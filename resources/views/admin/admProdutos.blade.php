@extends('layouts.appAdmin')
@section('content')


    <main class="container pt-3 ajuste" id="barraPedidos">
        <div class="row">
            
            <h2 class="col-12 p-3 mb-3 border-bottom">Produtos</h2>
            <div class="col-12 mt-3 mb-3">
                <p>Pesquise por uma Produto:</p>
                <form action="#" method="GET">
                    <div class="input-group col-12 px-0">
                        <input class="form-control border-0" id="myInput" type="search" arial-label="search" placeholder="Pesquisar..." name='search'>
                        <div class="input-group-append">
                            <button class="btn btn-primary px-5" type="submit">Pesquisar</button>
                        </div>

                    </div>
                </form>
                <div id="table"  class="tableAdm">
                    <table class="table table-striped text-center mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <!-- Por alguma razao as paginas Adm nao estao puxando codigo CSS entao inclui style individual em cada imagem -->
                                <th scope="col">ID</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço (BRL)</th>
                                <th scope="col">Categoria</th>
                                <th scope="col" colspan="2">Ações</th>
            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                            <tr>
                                <td scope="row">{{ $produto->id }}</td>
                                <td scope="row"><img src="{{ $produto->imagem }}" alt="" id="thumbProduto"
                                        style="max-height: 50px;"></td>
                                <td scope="row">{{ $produto->nome }}</td>
                                <td scope="row">{{ $produto->preco }}</td>
                                <td scope="row">{{ $produto->categoria }}</td>                   
                                <td>
                                    <a href="#">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modal">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

            <!-- Modal Excluir -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <h3>Computador</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="Bolsas">
                            <button type="button" class="btn btn-danger">Excluir</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <p class="font-weight-bold">Adicionar Produto
            <a href="#" data-toggle="modal" data-target="#modalAdd">
                <i class="far fa-plus-square"></i>
            </a>
        </p>


        <!-- Modal Adicionar -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicione um produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <form class="container">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="uploadImg">Imagem</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" lang="pt">
                                    <label class="custom-file-label" for="customFileLang">Esolha o arquivo</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputProduto">Produto</label>
                                <input type="text" class="form-control" placeholder="Insira o nome do produto"
                                    aria-describedby="adicionarProdutoHelp" id="inputProduto" name="inputProduto"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCategoria">Categoria</label>
                                <select class="custom-select">
                                    <option value="1">Bolsas</option>
                                    <option value="2">Livros</option>
                                    <option value="3">Eletrônicos</option>
                                    <option value="4">Outros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputSobrenome">Preço</label>
                                <input type="number" class="form-control" placeholder="Insira o preço do produto"
                                    aria-describedby="adicionarPrecoHelp" id="inputPreco" name="inputPreco"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="staticID">ID</label>
                                <input type="text" readonly class="form-control-plaintext" placeholder="000"
                                    aria-describedby="assuntoHelp" id="inputAssunto" name="inputAssunto">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Adicionar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>


@endsection