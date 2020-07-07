@extends('layouts.app')
@section('content')
    <section class="container mt-3">
        <div class="row">
            <div class="col-12">
                <p><small><a href="index">Página inicial</a> > <a href="eletronicos">Eletrônicos</a> > Computador</small></p>
            </div>
            <div class="col-md-5">
                <div>
                    <img class="d-block w-100 .produto" src={{asset('img/eletronico-03.png')}} alt="">
                </div>
            </div>
            <div class="col-md-7 my-3">
                <h2>Playstation 3</h2>
                <small>Indentificação do Produto</small>
                <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati in odit ratione recusandae excepturi voluptates blanditiis ex, iusto veniam voluptas asperiores, assumenda eos. Voluptate omnis deleniti repellendus velit necessitatibus qui!
                </p>
                <form action="./carrinho" method="GET" id="formComprar">
                    <div class="container">
                        <div class="row border">
                            <div class="col-md-4">
                                
                                    <div class="form-row mt-2">
                                        <div class="form-group col-md-12">
                                            <label for="inputTamanho">Modelo</label>
                                            <select class="form-control" name="inputTamanho" id="inputTamanho">
                                                <option disabled="" selected="">--</option>
                                                <option value="250">250 GB Ram</option>
                                                <option value="500">500 GB Ram</option>
                                                <option value="1000">1T Ram</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="quantidade">Quantidade</label>
                                            <input type="number" class="form-control" id="quantidade" step="1" min="1" value="1" required>
                                        </div>
                                    </div>
    
                                
                            </div>
                                
                            <div class="col-md-8 d-flex flex-column justify-content-center text-center bg-light ">
                                <div class="form-group">
                                    <p class="m-0"  id="precoDetalhe">R$ 1.399,00</p>
                                    <small>12x de R$ 116,58 s/ juros</small>
                                </div>
                                <div class="form-group m-0">
                                    <button type="submit" class="mx-auto my-2 btn btn-primary comprar"><i class="fas fa-shopping-cart"></i> comprar</button>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </form>





            </div>
        </div>

        <!-- ACCORDION -->
        <div class="row">
            <div class="col-12 my-5">
                <div class="accordion" id="accordionTabsProduto">

                    <div>
                        
                        <button class="acordeao my-2" type="button" data-toggle="collapse" data-target="#titulo1" aria-expanded="false" aria-controls="titulo1"><p class="m-0"> Ficha Técnica <i class="fas fa-chevron-down ml-3 font-weight-light"></i></p>
                       
                        </button>

                        <div id="titulo1" class="collapse" aria-labelledby="aba01" data-parent="#accordionTabsProduto">
                            <div class="card-body">

                                <table class="table table-striped text-center">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Codigo</th>
                                            <td>XXXXXX</td>
                                        </tr>
                                        <tr>
                                            <th>SSD</th>
                                            <td>Não possui</td>
                                        </tr>
                                        <tr>
                                            <th>Teclado</th>
                                            <td>Comum</td>
                                        </tr>



                                    </tbody>


                                </table>


                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="acordeao my-2" type="button" data-toggle="collapse" data-target="#titulo2" aria-expanded="false" aria-controls="titulo2"><p class='m-0'>Avaliações <i class="fas fa-chevron-down ml-3 font-weight-light"></i></p>
                        </button>

                        <div id="titulo2" class="collapse" aria-labelledby="aba02" data-parent="#accordionTabsProduto">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, nobis delectus! Sequi, ipsum exercitationem neque blanditiis provident officia. Officia distinctio totam hic repellat! Delectus, reiciendis? Quae nobis optio provident minus?
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>


    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 pb-1 pb-md-0 mb-3">
                <a href="detalheProduto">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="img\livro-01.png" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">Samsung S20</h3>
                            <p class="card-text preco">R$ 900,00</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 pb-1 pb-md-0  mb-3">
                <a href="detalheProduto">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="img\livro-02.png" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">Computador Zika</h3>
                            <p class="card-text preco">R$ 900,00</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 pb-1 pb-md-0">
                <a href="detalheProduto">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="img\livro-03.png" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">Controle PS5</h3>
                            <p class="card-text preco">R$ 900,00</p>
                        </div>
                    </div>
                </a>
            </div>   
            <div class="col-md-3 pb-1 pb-md-0">
                <a href="detalheProduto">
                    <div class="card avancar">
                        <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                            <img src="img\livro-04.png" alt="Card image cap" width="140px" height="140px">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title produto">Controle PS5</h3>
                            <p class="card-text preco">R$ 900,00</p>
                        </div>
                    </div>
                </a>
            </div>     
        </div>
    </div>
    <div class="row">
    <br>
    </div>
    <div class="container">
    <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">&raquo;</a>
                        </li>
                    </ul>
                </nav>
    </div>


@endsection
