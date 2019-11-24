<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate" />
    <meta name="description" content="{{$hotel->about}}" />
    <meta name="keywords" content="Hotel, Angola, Benguela, Luanda, Cabinda, 
    Quartos baratos, {{$hotel->about}}, {{$hotel->name}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$hotel->name}} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <link rel="icon" type="image/png" href="/storage/imgs/planoz.png" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
</head>
<style>
  .nav-link {
    color: #fff !important;
  }
</style>
<body style="">
<?php
use Carbon\Carbon;
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-primary 
shadow-sm mb-0">
<div class="container">
    
  <a class="navbar-brand text-white" href="/">
    
    {{$hotel->name}}</a>
  <button class="navbar-toggler" style="border: 0; color: #fff" type="button" data-toggle="collapse" 
  data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars"></i>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample01">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="#room">Quartos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#resourc">Recursos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#meal">Cardápio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#gallery">Galeria</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact">Contacto</a>
        </li>
      </ul>
  </div>

</div>
</nav>

@if($hotel->galleries->count() > 0)
    @foreach ($hotel->galleries as $photo)
        @if($photo->cover == 1)
        <img style="
        height: 400px;
        object-fit: cover;" src="{{asset($photo->image)}}" 
        class="card-img-top mt-0" alt="" srcset="">
        @endif
    @endforeach
@endif

<div style="text-align: center">
<img style="height: 100px; width: 100px; object-fit: cover;margin: 0 auto; margin-top: -50px; " 
src="{{asset($hotel->image)}}" 
            class="mr-1" alt="" srcset="">
</div>
<div style="padding: 40px 80px; background: #ffffff; font-size:22px; text-align: center">
  {{$hotel->about}}
</div>

@if($hotel->rooms->count() > 0)
<div class="mt-0 mb-0" style="background: #eba834; padding: 80px">
<h5 id="room" class="text-center display-3 mb-4">Quartos</h5>
  <div class="row">
    @foreach ($hotel->rooms as $room)
      <div class="col-md-3 col-sm-6">
      <div class="card p-4 mb-4">
        <div>
            <img style="height: 200px; object-fit: cover;" src="{{asset($room->image)}}" 
            class="card-img-top" alt="" srcset="">
          {{$room->name}}<br>
          <h4>{{number_format($room->price, 2, ',','.')}} Kz</h4>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endif

@if($hotel->resourcs->count() > 0)
<div class="hotels mt-0 mb-0" style="background: #2dc2a9; padding: 80px">
  <h5 id="resourc" class="text-center display-4">Recursos</h5>
    <ul class="list-group">
    @foreach ($hotel->resourcs as $resourc)
        <li class="list-group-item">
          <i class="fa fa-edit"></i>
          {{$resourc->name}}
        </li>
    @endforeach
  </ul>
</div>
@endif

@if($hotel->meals->count() > 0)
<div class="hotels mt-0 mb-0" style="background: #f7fcfc; padding: 80px">
  <h5 id="meal" class="text-center display-4">Nosso Cardápio</h5>
  
  <div class="row">

    @foreach ($hotel->meals as $meal)
      <div class="col-md-3 col-sm-6">
      <div class="card p-4 mb-4">
        <div>
            <img style="height: 200px; object-fit: cover;" src="{{asset($meal->image)}}" 
            class="card-img-top" alt="" srcset="">
          {{$meal->name}}<br>
          <h4>{{number_format($meal->price, 2, ',','.')}} Kz</h4>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endif

@if($hotel->events->count() > 0)

<div class="events mb-0" style="background: #50a9d9; padding: 80px">
  <h5 id="resourc" class="text-center display-4">Próximos eventos</h5>
  
  <div class="row">

    @foreach ($hotel->events as $event)
    <?php
    $todays_date = date("Y-m-d"); 
    $today = strtotime($todays_date);
    $unixTimestamp = strtotime($event->dateevent);
    if ($unixTimestamp > $today) 
    {      
    ?>
      <div class="col-md-4 col-sm-6">
      <div class="card p-4 mb-4">
        <div>
            <img style="height: 200px; object-fit: cover;" src="{{asset($event->image)}}" 
            class="card-img-top" alt="" srcset="">
          <h5>{{$event->name}}</h5>

          {{dateProcess($event->dateevent)}}
          <br>
          <p>{{ number_format($event->price, 2, ',','.') }} akz</p>
        </div>
      </div>
    </div>
    <?php } ?>
    @endforeach
   </div>
</div>
@endif

@if($hotel->galleries->count() > 0)
<h5 class="alert badge-dark text-center mb-0  text-white" 
style="border-radius:0;" id="gallery">Galeria</h5>
<div class="hotels mb-0 bg-white ">
  
  <div class="row">

    @foreach ($hotel->galleries as $photo)
      <div class="col-md-4 col-sm-6">
      <div class="">
        <div>
            <img src="{{asset($photo->image)}}" 
            class="card-img-top" alt="" srcset="">
          <p>{{$photo->desc}}</p>
        </div>
      </div>
    </div>
    @endforeach
   </div>
</div>
@endif

<h5 id="resourc" class="text-center display-4 text-uppercase m-0 p-0 bg-light">Contactos</h5>
<div class="contacts">
<div class="" id="contact">

  <div class="p-5 mb-3  text-center" style="font-size: 23px; ">
      @if($hotel->phone1 != "")
        <i class="fa fa-phone"></i> {{$hotel->phone1}}
      @endif
      @if($hotel->phone2 != "")
        <i class="fa fa-phone"></i> {{$hotel->phone2}}
      @endif
      @if($hotel->email != "")
      <i class="ml-3 fa fa-envelope" aria-hidden="true"></i> {{$hotel->email}}
      @endif
      <br>
      @if($hotel->website != "")
      <i class="ml-3 fa fa-globe" aria-hidden="true"></i>  
      @endif
      @if($hotel->facebook != "")
        <i class="ml-3 fab fa-facebook"></i>
      @endif

      @if($hotel->instagram != "")
        <i class="ml-3 fab fa-instagram"></i>
      @endif

  </div>
  {!!$hotel->map!!}
</div>

<div>
  <h1>Envie uma mensagem</h1>
<form method="POST" action="/messages/send">
    @csrf
    <div class="form-group">
      <label for="name">Nome</label>
      <input type="text" class="form-control" id="name" name="name" aria-describedby="name" 
      placeholder="Digite seu nome">
     
    </div>
    <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
    <div class="form-group">
      <label for="email">Email ou telefone</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email ou Telefone">
    </div>
    <div class="form-group">
      <label for="message">Mesnagem</label>
      <textarea class="form-control" id="message" name="message"
       placeholder="Mensagem..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>

</div>

<div class="text-center" style="padding: 40px; background: #ddd; color: #444; 
font-size:20px; ">
<a href="/termos-e-condicoes" class="mr-3">Termos e condições</a>
 <a href="/help">Centro de ajuda</a><br><br>
  A {{ config('app.name', 'Laravel') }} foi desenvolvida para ajudar pessoas a consultarem hotéis, hospedarias
  e restaurantes com apenas uns cliques. Disponível para computadores, tábletes e telemóveis
</div>
<div class="footer mt-0" style="background:#444; color: #fff; padding: 25px; text-align: center">
    <?php echo 'Copyright &copy; ' . date("Y"); ?> Direitos reservados
</div>

</body>
</html>
