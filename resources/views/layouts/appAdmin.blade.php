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
            <a class="navbar-brand" href="/">
                <img src={{asset('img/logo.png')}} alt="Logo" width=65px height=50px>
            </a>
            <div class="d-flex flex-column text-right dropdown">
              @guest
              <p class="m-0 text-white admin">Painel Administrativo</p>

              @else
              <p class="m-0 text-white admin">Painel Administrativo</p>
              @if (Auth::user()->admin==1)
              <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Olá, {{ Auth::user()->nome }}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Sair</a>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </div>
              @endif
            </div>
            @endguest
                  


          </div>
        </nav>
      <div class="subnav">
          <div class="container">
              <div class="d-flex">
                  <ul class="d-flex flex-row">
                    <li class="d-flex"><a class="d-flex align-items-center justify-content-center" href="/admin/admUsuarios">Usuários</a></li>
                    <li class="d-flex"><a class="d-flex align-items-center justify-content-center" href="/admin/admProdutos">Produtos</a></li>
                    <li class="d-flex"><a class="d-flex align-items-center justify-content-center" href="/admin/admCategorias">Categorias</a></li>
                    <li class="d-flex"><a class="d-flex align-items-center justify-content-center" href="/admin/admMensagens">Mensagens</a></li>
                  </ul>
              </div>
          </div>
      </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="container-fluid mt-3 mb-0 mx-0 px-0">
      <div id="footer">

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

  </div>


</body>
</html>