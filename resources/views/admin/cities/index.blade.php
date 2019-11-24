@extends('layouts.app')
@section('title', 'Cidades')
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
            <h4 class="display-6">Cidades</h4>   
            <a href="{{ route('cities.create')}}" class="form-control"><i class="fa fa-plus "></i></a> 
            <br>
          <table class="table table-striped">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Cidade</td>
                  <td>Hotéis</td>
                  <td>Província</td>
                  <td>Publicada por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                <tr>
                    <td>{{$city->id}}</td>
                    <td>{{$city->name}}</td>
                    <td>{{$city->hotels->count()}}</td>
                    <td>{{$city->province->name}}</td>
                    <td>{{$city->user->name}}</td>
                    <td>
                        <a href="{{ route('cities.edit',$city->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$city->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar a cidade de {{$city->name}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('cities.destroy', $city->id)}}" method="post">
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

            {{$cities->links()}}
        </div>


</div>
@endsection