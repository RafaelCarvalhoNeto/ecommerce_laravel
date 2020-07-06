@extends('layouts.app')
@section('content')
 
<div class="container ajuste">
    <h2 class="col-12 p-3 mt-4 mb-3 border-bottom font-weight-bold">Painel Administrativo</h2>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <a href="admUsuarios">
                <div class="row bg-dark text-white m-0 mb-3 avancar p-3" style="align-items:center">
                    <div class="col-lg-4 col-md-12 p-0 text-center">
                        <p class=" display-4 m-0"><i class="fas fa-users"></i></p>
                    </div>
                    <div class="p-3 col-lg-8 col-md-12 text-white">
                        <h4>Administração de Usuários</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-12">
            <a href="/admCategorias">
                <div class="row bg-primary text-white m-0 mb-3 avancar p-3" style="align-items:center">
                    <div class="col-lg-4 col-md-12 p-0 text-center">
                        <p class=" display-4 m-0"><i class="fas fa-network-wired"></i></p>
                    </div>
                    <div class="p-3 col-lg-8 col-md-12">
                        <h4>Administração de Catergorias</h4>
                    </div>
                </div>
            </div>
            </a>
        <div class="col-md-6 col-sm-12">
            <a href="admProdutos">
                <div class="row bg-primary text-white m-0 mb-3 avancar p-3" style="align-items:center">
                    <div class="col-lg-4 col-md-12 p-0 text-center">
                        <p class=" display-4 m-0"><i class="fas fa-tv"></i></p>
                    </div>
                    <div class="p-3 col-lg-8 col-md-12">
                        <h4 class="card-text">Administração de Produtos</h4>
                    </div>
                </div>


            </a>
        </div>
        <div class="col-md-6 col-sm-12">
            <a href="admMensagens">
                <div class="row bg-dark text-white m-0 mb-3 avancar p-3" style="align-items:center">
                    <div class="col-lg-4 col-md-12 p-0 text-center">
                        <p class=" display-4 m-0"><i class="fas fa-envelope-open"></i></i></p>
                    </div>
                    <div class="p-3 col-lg-8 col-md-12">
                        <h4>Administração de Mensagens</h4>
                    </div>
                </div>

            </a>
        </div>
    </div>


</div>
                    

@endsection