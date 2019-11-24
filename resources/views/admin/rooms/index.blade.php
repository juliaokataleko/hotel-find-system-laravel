@extends('layouts.app')

@section('title', 'Quartos')

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
            <h4 class="display-6">Quartos <a href="{{ route('rooms.create')}}"  
            class="btn btn-primary"><i class="fa fa-plus"></i></a></h4>   
    
            @if($rooms->count() > 0)
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td>ID</td>
                      <td>Nome</td>
                      <td>Hotel</td>
                      <td>Preço</td>
                      <td>Publicada por</td>
                      <td colspan = 2>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>
                            <img src="{{asset($room->image)}}" 
                            class="card-img-top" style="width:100px" alt="" srcset="">
                        </td>
                        <td>{{$room->name}}</td>
                        <td>{{$room->hotel->name}}</td>
                        <td>{{number_format($room->price, 2, ',','.')}} Kz</td>
                        <td>{{$room->user->name}}</td>
                        <td>
                            <a href="{{ route('rooms.edit',$room->id)}}" class="btn btn-primary">Alterar</a>
                        </td>
                        <td>
    
                        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
                        data-target="#exampleModalCenter{{$room->id}}">
                        Eliminar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                Deseja eliminar o quarto: {{$room->name}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                
                                <form action="{{ route('rooms.destroy', $room->id)}}" method="post">
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

            {{$rooms->links()}}
        </div>


</div>
@endsection