<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Encontre um hotelem qualquer cidade de Angola." />
    <meta name="keywords" content="Hotel, Angola, Benguela, Luanda, Cabinda, 
    Quartos baratos, Hotéis com qualidade, Hospedarias, Pensões, 
    Aluguel de salões, Restaurantes, Onde comer, Onde beber, Fim-de-semana, Piscinas, restaurantes" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/assets/css/all.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('/storage/imgs/kor.png') }}" />
  </head>

  <body style="padding-top: 56px;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" style="border: 0; color: #fff" type="button" data-toggle="collapse" 
        data-target="#navbarResponsive" aria-controls="navbarResponsive" 
        aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/"> <i class="fa fa-home"></i>
              </a>
            </li>
            <li class="nav-item active">
              <a href="#about" class="nav-link" data-toggle="modal" 
              data-target="#exampleModal"> Locais</a>
            </li>
            <li class="nav-item active">
              <a href="/central-de-ajuda" class="nav-link" >FAQ</a>
            </li>
            <li class="nav-item active">
              <a href="" class="nav-link" data-toggle="modal" data-target="#exampleModalContact">Contactos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="text-center" style="padding: 10px; background: #555">
      @auth
      <a href="/dashboard" class="text-white">{{Auth::user()->name}}</a> 
      @else
      <a href="/login" class="text-white">Login</a>
      @endauth
      | <span class="text-white">Redes socias:</span> 
      <a class="text-white" href="http://"><i class="fab fa-facebook"></i></a>
      <a class="ml-2 text-white" href="http://"><i class="fab fa-twitter"></i></a>
      <a class="ml-2 text-white" href="http://"><i class="fab fa-instagram"></i></a>
    </div>

    <div class="jumbotron text-center bg-warning">
      <img src="/storage/imgs/kor.png" style="height: 5em;" alt="" srcset="">
    </div>

    <!-- Page Content -->
    <div class="container" style="max-width: 800px;">

      <!-- Page Heading -->
      <h1 class="my-4">
        Hotéis: 
        @if($cityUser != "Clica numa cidade")
        {{$cityUser}} 
        <a href="/clear-place">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
        @else
        Angola
      @endif
      </h1>
      @if($hotels->count() > 0)
      @foreach ($hotels as $hotel)
      <!-- Project One -->
      <div class="row">
        <div class="col-md-3">
          <a href="/{{$hotel->slug}}">
              <img src="{{asset($hotel->image)}}" 
              class="img-fluid border rounded mb-3 mb-md-0" alt="{{$hotel->name}}" srcset="">
          </a>
        </div>
        <div class="col-md-9">
            <a href="/{{$hotel->slug}}"><h3>{{$hotel->name}}</h3></a>
          <p>{{$hotel->about}}</p>
          <a class="btn btn-primary" href="/{{$hotel->slug}}">Visitar hotel</a>
        </div>
      </div>
      <hr>
      <!-- /.row -->
      @endforeach
      @endif


      <!-- Pagination -->
      {{$hotels->links()}}

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; {{ config('app.name', 'Laravel') }}  <?php echo date("Y"); ?></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Modal das cidades -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Escolhe uma cidade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <ul class="list-group">
                @foreach($cities as $city)
                  @if($city->hotels->count() > 0)
                    <li class="list-group-item">
                    <a href="/city/{{$city->id}}">
                    {{$city->name}}</a></li>
                  @endif
                @endforeach
              </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Modal de contactos -->
    <div class="modal center fade" id="exampleModalContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Fale connosco</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <h1>PRECISA DE NOSSA AJUDA?</h1>
              <P>fale connosco</P>
              <i class="border p-2 fa fa-phone"></i> +244 922 660 717 <br>
              <i class="border p-2 mt-1 fa fa-inbox"></i> Juliofeli78@gmail.com
              <br><br>Mande-nos uma mensagem.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>


    <script src="{{ asset('/assets/js/jquery.superslides.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/js/typed.min.js') }}"></script>
    <script src="{{ asset('/assets/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/script.js') }}"></script>
  </body>

</html>