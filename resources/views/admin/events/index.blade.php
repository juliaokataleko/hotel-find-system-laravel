@extends('layouts.app')
@section('title', 'Eventos')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
        </div>

        <div class="col-sm-12">
                <h4 class="display-6">Eventos <a 
                href="{{ route('events.create')}}"   class="btn btn-primary"><i class="fa fa-plus"></i></a></h4>   
            @if($events->count() > 0)
            <br>
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <td>Capa</td>
                  <td>Título</td>
                  <td>Data</td>
                  <td>Hotel</td>
                  <td>Preço</td>
                  <td>Registado por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>


                @foreach($events as $event)
                <tr>
                    <td>
                        <img src="{{asset($event->image)}}" 
                        class="card-img-top" style="width:100px" alt="" srcset="">
                    </td>
                    <td>{{$event->name}}</td>
                    <?php
                      $dateTime = Carbon::createFromTimestamp(
                        $event->dateeven,
                      new \DateTimeZone('Africa/Luanda')
                  );
                    ?>
                    <td <?php
                    $todays_date = date("Y-m-d"); 
                    $today = strtotime($todays_date);
                    $unixTimestamp = strtotime($event->dateevent);
                    if ($unixTimestamp <= $today) 
                    {      
                    ?>
                        class="text-danger"
                    <?php } ?>
                    
                    >
                        {{ dateProcess($event->dateevent) }}</td>
                    <td>{{$event->hotel->name}}</td>
                    <td>
                        {{number_format($event->price, 2, ',','.')}} Kz
                    </td>
                    <td>{{$event->user->name}}</td>
                    <td>
                        <a href="{{ route('events.edit',$event->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$event->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar o evento {{$event->name}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('events.destroy', $event->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Excluir</button>
                            </form>
        
                        </div>
                        </div>
                    </div>
                    </div>

                    </td>
                </tr>
                @endforeach




            </tbody>
          </table>
          @endif
        <div>

            {{$events->links()}}
        </div>


</div>
@endsection