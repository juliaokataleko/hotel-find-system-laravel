@extends('layouts.app')
@section('title', 'Províncias')
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
            <h4 class="display-6">Províncias</h4>   
            <a href="{{ route('provinces.create')}}" class="form-control">Adicionar</a> 
            <br>
          <table class="table table-striped">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Nome</td>
                  <td>Cidades</td>
                  <td>Publicada por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($provinces as $province)
                <tr>
                    <td>{{$province->id}}</td>
                    <td>{{$province->name}}</td>
                    <td>{{$province->cities->count()}}</td>
                    <td>{{$province->user->name}}</td>
                    <td>
                        <a href="{{ route('provinces.edit',$province->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
                    data-target="#exampleModalCenter{{$province->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$province->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar a província: {{$province->name}}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('provinces.destroy', $province->id)}}" method="post">
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

        {{$provinces->links()}}
        </div>


</div>
@endsection