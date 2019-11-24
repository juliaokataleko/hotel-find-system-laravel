@extends('layouts.app')
@section('title', 'Contactos')
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
            <h4 class="display-6">Contactos</h4>   
            <a href="{{ route('contacts.create')}}" class="form-control">Adicionar novo</a> 
            <br>
          <table class="table table-striped">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Nome</td>
                  <td>Telefone</td>
                  <td>Email</td>
                  <td>Publicada por</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td> <i class="fa fa-phone"></i>  </td>
                    <td>{{$contact->name}}</td>
                    <td>{{ $contact->phone }} {{ $contact->phone2 }}</td>
                    <td>{{ $contact->email }} {{ $contact->email2 }}</td>
                    <td>{{$contact->user->name}}</td>
                    <td>
                        <a href="{{ route('contacts.edit',$contact->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$contact->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar o contacto de {{$contact->name}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
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

            {{$contacts->links()}}
        </div>


</div>
@endsection