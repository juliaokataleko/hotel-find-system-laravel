@extends('layouts.app')

@section('title', 'Recursos')

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
            <h4 class="display-6">Recursos <a href="{{ route('resourcs.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a></h4>   
            
            <br>
            @if ($resourcs->count() > 0)
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Nome</td>
                          <td>Hotel</td>
                          <td>por</td>
                          <td colspan = 2>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
        
                        @foreach($resourcs as $resourc)
                        <tr>
                            <td>
                                    {{$resourc->id}}
                            </td>
                            <td>{{$resourc->name}}</td>
                            <td>{{$resourc->hotel->name}}</td>
                            <td>{{$resourc->user->name}}</td>
                            <td>
                                <a href="{{ route('resourcs.edit',$resourc->id)}}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
        
                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
                            data-target="#exampleModalCenter{{$resourc->id}}">
                            Eliminar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$resourc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    Deseja eliminar: {{$resourc->name}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    <form action="{{ route('resourcs.destroy', $resourc->id)}}" method="post">
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

            {{$resourcs->links()}}
        </div>


</div>
@endsection