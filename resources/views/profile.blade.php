@extends('layouts.app')
@section('title', 'Painel')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif

        @if(session()->get('warning'))
            <div class="alert alert-warning">
            {{ session()->get('warning') }}  
            </div>
        @endif

        <h1>{{ Auth::user()->name}}</h1>
        <hr>
        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
        data-target="#exampleModalCenterCount">
        editar conta
        </button>

        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
        data-target="#exampleModalCenterChange">
        Alterar palavra-passe
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenterChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Alterar Palavra-passe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                    <form method="POST" action="/dashboard/changepassword">
                        @csrf
            
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Palavra-passe actual</label>
            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="off" autofocus>
            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nova palavra-passe</label>
            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" required autocomplete="off" autofocus>
            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Repetir a nova palavra-passe</label>
            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="repeat_password" value="{{ old('repeat_password') }}" required autocomplete="off" autofocus>
            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Alterar palavra-passe
                                </button>
            
                                
                            </div>
                        </div>
                    </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                

            </div>
            </div>
        </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenterCount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Edita conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               

                    <form method="POST" action="/dashboard/update-profile">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control 
                                @error('name') is-invalid @enderror" name="name" 
                                 required 
                                autocomplete="off" value="{{ Auth::user()->name }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Userame') }}</label>
    
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') 
                                    is-invalid @enderror" name="username" 
                                    value="{{ Auth::user()->username }}" required autocomplete="off" autofocus>
    
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar perfil
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                

            </div>
            </div>
        </div>
        </div>
        <hr>
        
        </div>

        @if(Auth::user()->role == 1)
        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Hotéis registados: {{ $user->hotels->count() }}</div>
            </div> 
        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Províncias: {{ $user->provinces->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Cidades: {{ $user->cities->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Contactos: {{ $user->contacts->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Notas: {{ $user->notes->count() }}
            </div> 
        </div>
        @endif

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Eventos: {{ $user->events->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Refeições: {{ $user->meals->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Fotografias: {{ $user->galleries->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Quartos: {{ $user->rooms->count() }}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="card p-4 mt-3">
                Recursos: {{ $user->resourcs->count() }}
            </div> 
        </div>

    </div>
</div>
@endsection