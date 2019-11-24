@extends('layouts.app')
@section('title', 'Notas')
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
            <h4 class="display-6">Notas</h4>   
            <a href="{{ route('notes.create')}}" class="form-control">Adicionar nota</a> 
            <br>
            <div class="row">
            
                @foreach($notes as $note)
                <div class="col-md-4">
                    <div class="card p-4 border bg-white mb-4">
                    {!! nl2br($note->note) !!} por {{$note->user->name}}
                    <hr>
                    <a href="{{ route('notes.edit',$note->id)}}" class="">Alterar</a>
                    <a class="" data-toggle="modal" href="" 
                    data-target="#exampleModalCenter{{$note->id}}">Eliminar
                    </a>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$note->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar a nota: {{$note->note}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('notes.destroy', $note->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Excluir</button>
                            </form>
        
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            
            </div>

        <div>

            {{$notes->links()}}
        </div>


</div>
@endsection