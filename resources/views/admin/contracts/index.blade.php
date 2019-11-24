@extends('layouts.app')
@section('title', 'Contratos')
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
            <h4 class="display-6">Contractos</h4>   
            <a href="{{ route('contracts.create')}}"class="form-control">Adicionar contracto</a> 
            <br>
            @if ($contracts->count() > 0)
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Hotel</td>
                          <td>Data</td>
                          <td>por</td>
                          <td colspan = 2>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
        
                        @foreach($contracts as $contract)
                        <tr>
                            <td>
                                <img src="{{asset($contract->doc)}}" 
                                class="card-img-top" style="width:100px" alt="" srcset="">
                            </td>
                            <td>{{$contract->hotel->name}}</td>
                            <td>{{$contract->dateassign}}</td>
                            <td>{{$contract->user->name}}</td>
                            <td>
                                <a href="{{ route('contracts.edit',$contract->id)}}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
        
                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
                            data-target="#exampleModalCenter{{$contract->id}}">
                            Eliminar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$contract->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    Deseja eliminar: {{$contract->name}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    <form action="{{ route('contracts.destroy', $contract->id)}}" method="post">
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

            {{$contracts->links()}}
        </div>


</div>
@endsection