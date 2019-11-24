@extends('layouts.app')
@section('title', 'Hotéis')
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
                <h4 class="display-6">Hotéis
                 <a href="{{ route('hotels.create')}}" 
                class="btn btn-primary"><i class="fa fa-plus"></i></a></h4>   
            <br>
            
          <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <td>Imagem</td>
                  <td>Nome</td>
                  <td>Cidade</td>
                  <td>Quartos</td>
                  <td>Mapa</td>
                  <td>Registado por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                <tr>
                    <td>
                        <img src="{{asset($hotel->image)}}" 
                        class="card-img-top" style="width:100px" alt="" srcset="">
                    </td>
                    <td>{{$hotel->name}}</td>
                    <td>{{$hotel->city->name}}</td>
                    <td>{{$hotel->rooms->count()}}</td>
                    <td>{!! $hotel->map !!}</td>
                    <td>{{$hotel->user->name}}</td>
                    <td>
                        <a href="{{ route('hotels.edit',$hotel->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$hotel->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar o hotel {{$hotel->name}}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('hotels.destroy', $hotel->id)}}" method="post">
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
        <div>

            {{$hotels->links()}}
        </div>


</div>
@endsection