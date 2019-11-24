@extends('layouts.app')
<?php
use Carbon\Carbon;
?>
@section('title', 'Cardápios')
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
            <h4 class="display-6">Cardápios  <a href="{{ route('meals.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h4>   
            
            @if($meals->count() > 0)
            <br>
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <td>Capa</td>
                  <td>Título</td>
                  <td>Hotel</td>
                  <td>Preço</td>
                  <td>Registado por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>


                @foreach($meals as $meal)
                <tr>
                    <td>
                        <img src="{{asset($meal->image)}}" 
                        class="card-img-top" style="width:100px" alt="" srcset="">
                    </td>
                    <td>{{$meal->name}}</td>
                    <td>{{$meal->hotel->name}}</td>
                    <td>{{number_format($meal->price, 2, ',','.')}} Kz</td>
                    <td>{{$meal->user->name}}</td>
                    <td>
                        <a href="{{ route('meals.edit',$meal->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$meal->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar o prato: {{$meal->name}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('meals.destroy', $meal->id)}}" method="post">
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

            {{$meals->links()}}
        </div>


</div>
@endsection