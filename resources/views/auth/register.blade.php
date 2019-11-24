@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
            <div class="col-md-12" style="max-width: 500px;">
                    <div class="card-header">
                        <h2>Abrir conta</h2>
                    </div>

                <div class="card-body badge-light">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input id="name" placeholder="Nome" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input id="username" placeholder="Nome de usuário" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input id="email" placeholder="Correio electrónico" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input id="password" placeholder="Palavra-passe" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                       
                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="Repetir palavra-passe" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <br><br>
                    <a href="/login">Já tens uma conta?<br>
                        <button class="btn mt-4 btn-info">Iniciar sessão</button>
                    </a>
                </div>

                

            </div>
    </div>
</div>
@endsection
