@extends('layouts.app')
@section('content')
    <div class="container pt-3">

        <div class="row">
            <div class="col-2">
                <h2 class="col-12 p-3 mb-3 border-bottom">Ofertas</h2>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Promoção</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Desconto</label>
                </div>
                <div class="list-group">
                    <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Preço</h2>
                    <div class="slidecontainer">
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                    </div>
                    <h2 class="col-12 p-3 mt-3 mb-3 border-bottom">Marca</h2>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Asus</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Sony</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Microsoft</label>
                    </div>

                 </div>

            </div>
            <div class="col-10">
                <div class="row text-center mt-4">
                    <div class="col-md-3 pb-1 pb-md-0 mb-3">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-01.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Playstation 4 com 20Gb de memoria</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-md-3 pb-1 pb-md-0  mb-3">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-02.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Atari - Um dos primeiros do mundo</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-03.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Console PS3 com 10 jogos exlusivos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-04.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Nintendo 64 e 4 controles e 200 jogos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-04.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Nintendo 64 e 4 controles e 200 jogos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-04.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Nintendo 64 e 4 controles e 200 jogos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-04.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Nintendo 64 e 4 controles e 200 jogos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 pb-1 pb-md-0">
                        <a href="detalheProduto.php">
                            <div class="card avancar">
                                <div class="card-img-top d-flex align-items-center justify-content-center p-4">
                                    <img src="img\eletronico-04.png" alt="Card image cap" width="140px" height="140px">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title produto">Nintendo 64 e 4 controles e 200 jogos</h3>
                                    <p class="card-text preco">R$ 900,00</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>

            </div>

        </div>
        <!-- Card deck -->


            

  
        

    </div>


@endsection