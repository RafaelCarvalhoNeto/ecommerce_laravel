<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-ekOryaXPbeCpWQNxMwSWVvQ0+1VrStoPJq54shlYhR8HzQgig1v5fas6YgOqLoKz" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
              <a class="navbar-brand" href="index">
                  <img src={{asset('img/logo.png')}} alt="Logo" width=65px height=50px>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                  <form class="form-inline ml-auto p-2 my-0">
                      <div class="input-group" id="busca">
                          <input class="form-control border-0" type="search" placeholder="Busca" aria-label="Search">
                          <div class="input-group-append">
                              <button class="search btn" type="submit"></button>
                          </div>
                      </div>
                  </form>
                  <a class="d-flex flex-column text-white m-2" href="#" data-toggle="modal" data-target="#modalLogin">
                      <small class="login m-0">Olá, faça seu login</small>
                      <small class="login m-0">ou cadastre-se</small>
                  </a>
                  

                  <a class="btn btn-outline-warning px-4 ml-2 arrendonar" href="carrinho"><i class="fas fa-shopping-cart"></i></a>
              </div>
          </div>
      </nav>
      <div class="subnav">
          <div class="container">
              <div class="row">
                  <ul>
                      <li><a href="./ofertas">Ofertas</a></li>
                      <li><a href="./livros">Livros</a></li>
                      <li><a href="./eletronicos">Eletrônicos</a></li>
                      <li><a href="./bolsas">Bolsas</a></li>
                  </ul>
              </div>
          </div>
      </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="container-fluid mt-5 mb-0 mx-0 px-0">
      <div id="footer">
        <div class=" bg-light">
          <div class="container">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-between my-0 text-center link-footer">
                <a href="./ofertas">Ofertas</a>
                <a href="./livros">Livros</a>
                <a href="./eletronicos">Eletrônicos</a>
                <a href="./bolsas">Bolsas</a>
              </div>
            </div>
          </div>
        </div>
        <div class="container text-white bg-dark pt-4">
            
          <div class="row">
            <div class="col-md-12 col-lg-12 text-center">
              <div class="d-flex flex-row flex-nowrap justify-content-center redes-sociais mb-2">
                <a href="#" target="_blank" title="Acesse nosso Insta"><i class="fab fa-instagram mr-2"></i></a>
                <a href="#" target="_blank" title="Acesse nosso Face"><i class="fab fa-facebook mr-2"></i></a>
                <a href="#" target="_blank" title="Acesse nosso Twitter"><i class="fab fa-twitter mr-2"></i></a>
                <a href="#" target="_blank" title="Acesse nosso Pinterest"><i class="fab fa-pinterest mr-2"></i></a>
              </div>
              <address>
                <strong>SAC</strong><br>
                <a href="mailto:#">ecommerce@exemplo.com</a>
              </address>
              <address>
                <strong>Nossa Loja &copy; | CNPJ 01.012.012/0001-99 | </strong>Rua Alameda Santos 110, Sao Paulo, SP, 9110-999 | <abbr title="Telefone">Tel:</abbr> (123) 456-7890
              </address>
              <div class="d-flex flex-row flex-nowrap justify-content-center pb-3 text-center">
                <a class="px-1" href="contato">Contato </a> | <a class="px-1" href="institucional">Institucional </a> | <a class="px-1" href="politicas">Termos de uso </a> | <a class="px-1" href="politicas"> Politicas de Privacidade</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
        <!-- Modal Login  -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLoginLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="meuemail@meuprovedor.com" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Nunca salve seu email em computadores públicos.</small>
              </div>
              <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" placeholder="insira sua senha" aria-describedby="passwordHelp">
                <small id="passwordHelp" class="form-text text-muted">Nunca salve sua senha em computadores públicos.</small>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="aceite">
                <label class="form-check-label" for="aceite">Concordo com a <a href="politicas">Políticas de Privacidade</a> e <a href="politicas">Termos de Uso</a></label>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Logar</button>
          </div>
          <label class="container justify-content-right mb-0">Ainda não tem cadastro? <a href="cadastro"><small>Cadastre-se Aqui!</small></a></label>
          <label class="container justify-content-right mb-4">Esqueceu sua senha? <a href="#"><small>Clique Aqui!</small></a></label>
        </div>
      </div>
    </div>

  </div>

    <!-- SCRIPTS -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
          $("#myInput").on("keyup", function () {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function () {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
          });
      });
    </script> --}}

</body>
</html>