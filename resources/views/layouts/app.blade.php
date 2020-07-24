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
  <div class='noir'></div>
  <div id="app">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
              <a class="navbar-brand" href="/">
                  <img src={{asset('img/logo.png')}} alt="Logo" width=65px height=50px>
              </a>


                <form action="{{ url('/search') }}" method="GET" class="form-inline ml-auto p-2 my-0">
                    <div class="input-group" id="busca">
                        <input class="form-control border-0" type="search" placeholder="Busca" aria-label="Search" name="search">
                        <div class="input-group-append">
                            <button class="search btn p-0" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                @guest
                <a class="text-white ola-nav p-2" href="#" data-toggle="modal" data-target="#modalLogin">
                    <small class="login m-0">Olá, faça seu login</small>
                    <small class="login m-0">ou cadastre-se</small>
                </a>
                @else
                <a class='link-ola-nav text-white' href="/usuarios/historicoPedidos">

                  <div id="acesso"class="dropdown ola-nav text-white p-2">
                    <small class="login m-0">Olá, {{ Auth::user()->nome }}</small>
                    <small class="login m-0 font-weight-bold dropdown-toggle" id="dLabel" aria-haspopup="true" aria-expanded="false">Acesse o perfil</small>
                    <div class="dropdown-menu" id="acessoOptions" aria-labelledby="dLabel">
                      @if (Auth::user()->admin==1)
                        <a class="dropdown-item" href="{{ route('admin') }}">Admin</a>
                      @endif
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Sair</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </div>

                </a>
                @endguest
                
                <div class='icon-carrinho'>
                  <a class="btn btn-outline-warning px-4 ml-2 arrendonar" href="/carrinho"><i class="fas fa-shopping-cart"></i></a>
                  <small class="bolinha">0</small>
                </div>

              
          </div>
      </nav>
      <div class="subnav">
        <div class="container">
          <div class="d-flex">
            <div class="btn-group" >
              <button type="button" id="btn-fade" class="btn btn-secondary dropdown-toggle btn-categorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bars mr-2"></i>Todas as Categorias
              </button>
              <div class="dropdown-menu d-categorias">
                @foreach ($todasAsCategorias as $tCategoria)
                <a class="dropdown-item" href="/categoria/{{$tCategoria->slug}}">{{$tCategoria->tipo}}</a>
                    
                @endforeach
              </div>
            </div>
            <ul>
             
              @foreach ($categoriasNav as $categoriaNav)
              <li class="d-flex"><a class="d-flex align-items-center justify-content-center"href="/categoria/{{$categoriaNav->slug}}">{{$categoriaNav->tipo}}</a></li>
                  
              @endforeach
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

                @foreach ($categoriasNav as $categoriaNav)
                <a href="/categoria/{{$categoriaNav->slug}}">{{$categoriaNav->tipo}}</a>
                    
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="container bg-dark pt-4">
            
          <div class="row ">
            <div class="col-md-12 col-lg-12 text-center">
              <div class="d-flex flex-row flex-nowrap  justify-content-center redes-sociais mb-2">
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
          <form action="{{ route('login') }}" method="POST">
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="meuemail@meuprovedor.com" name="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="insira sua senha" name="password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button> --}}
              <button type="submit" class="btn btn-primary btn-block">Logar</button>
            </div>
          </form>
          <label class="container justify-content-right mb-0">Ainda não tem cadastro? <a href="cadastro"><small>Cadastre-se Aqui!</small></a></label>
          <label class="container justify-content-right mb-4">Esqueceu sua senha? <a href="#"><small>Clique Aqui!</small></a></label>
        </div>
      </div>
    </div>

  </div>

  <script>
    let btn = document.getElementById('btn-fade');
    let noir = document.querySelector('.noir');
    btn.addEventListener('click', function(event){

      if(event.target.getAttribute('aria-expanded')=='false'){
        noir.classList.add('active-noir')
        btn.style.zIndex = 100
      }else{
        noir.classList.remove('active-noir')
      }
    })

    document.addEventListener('click', function(){
      if(btn.getAttribute('aria-expanded')=='true')
        noir.classList.remove('active-noir')
    })


  </script>


  @guest
  @else
  <script>
    let drop = document.getElementById('acesso');
    let dmenu = document.querySelector('#acessoOptions');
    let item = document.querySelectorAll('#acessoOptions .dropdown-item')[1]
    let nav = document.querySelector('.row')
    drop.addEventListener('mouseenter',function(){
      drop.classList.add('show')
      dmenu.classList.add('show')
    })
    nav.addEventListener('mouseenter',function(){
      drop.classList.remove('show')
      dmenu.classList.remove('show')
    })

    item.addEventListener('mouseout',function(){
      drop.classList.remove('show')
      dmenu.classList.remove('show')
    })
  </script>
  @endguest

</body>
</html>