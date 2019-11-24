<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title> 

  <!-- Bootstrap core CSS -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
  <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <meta name="google" content="notranslate" />
  <link rel="icon" type="image/png" href="/storage/imgs/kor.png" />
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right position-relative" id="sidebar-wrapper">
      <div class="sidebar-heading text-center">
        <a class="navbar-brand text-center" href="/">
        <img style="width: 100px;" class="border" src="{{ asset('/storage/imgs/kor.png') }}" alt="{{ config('app.name', 'Laravel') }}" srcset="">
        </a>
      </div>
      <div class="list-group list-group-flush">
        @auth
        <a class="list-group-item list-group-item-action bg-light" href="/dashboard/home"><i class="fa fa-home"></i> Painel inicial</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('photos.index') }}"><i class="far fa-images"></i> Galeria</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('resourcs.index') }}"><i class="fas fa-rocket"></i> Recursos</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('meals.index') }}"><i class="fas fa-utensils"></i> Cardápio</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('events.index') }}"><i class="far fa-calendar"></i> Eventos</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('rooms.index') }}"><i class="fa fa-map-marker"></i> Quartos</a>
        <a class="list-group-item list-group-item-action bg-light" href="/dashboard/messages"><i class="fa fa-inbox"></i> Mensagens</a>

        <a class="list-group-item list-group-item-action bg-light" href="/dashboard/visits"><i class="fa fa-eye"></i> Visitas</a>
        <?php if(Auth::user()->role == 1) { ?>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('hotels.index') }}"><i class="fa fa-map-marker"></i> Hotéis</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('cities.index') }}"><i class="fa fa-map-marker"></i> Cidades</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('provinces.index') }}"><i class="fa fa-map-marker"></i> Províncias</a>
        <a class="list-group-item list-group-item-action bg-light" href="/dashboard/users"><i class="fa fa-users"></i> Usuários</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('contracts.index') }}">Contratos</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('payments.index') }}">Pagamentos</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('finances.index') }}"><i class="fa fa-currency"></i> Finanças</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('contacts.index') }}"><i class="fa fa-phone"></i> Contactos</a>
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('notes.index') }}"><i class="fa fa-edit"></i> Notas</a>
        <?php } ?>
        
        <a class="list-group-item list-group-item-action bg-light" href="/profile"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
        <a data-target="#exampleModalCenter" data-toggle="modal"  class="list-group-item list-group-item-action bg-light" 
        href=""><i class="fa fa-edit"></i> Sair</a>
        
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Atenção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                   
                    Tens certeza que queres terminar a sua sessão??
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                
                <a class="btn btn-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Terminar sessão
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
            </div>
        </div>
        </div>

       @else
       <a class="list-group-item list-group-item-action bg-light" href="/login">Entre</a>
       <a class="list-group-item list-group-item-action bg-light" href="/register">Abrir conta</a>
       <a class="list-group-item list-group-item-action bg-light" href="/help">Ajuda</a>
       <a class="list-group-item list-group-item-action bg-light" href="/termos-e-condicoes">Política de</a>
       
       @endauth
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" target="_blank" href="/"> <i class="fa fa-home"></i> Página inicial <span class="sr-only">(current)</span></a>
            </li>
            @auth
            <li class="nav-item">
              <a class="nav-link" href="/visits">Visitas</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/profile">{{Auth::user()->name}}</a>
            </li>
            @endauth
           
          </ul>
        </div>
      </nav>

      <div class="container-fluid mt-4">
            @yield('content')
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>

