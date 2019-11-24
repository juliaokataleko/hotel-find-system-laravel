@extends('layouts.app')
@section('title', 'Entra na sua conta')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="max-width: 500px;">
                <div class="card-header">
                    <h2>Iniciar sessão</h2>
                </div>

                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input id="login" type="text" placeholder="Email ou nome de usuário"
                                       class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                         
                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <div class="col-md-12">
                                <input placeholder="Palavra-passe" id="password" 
                                type="password" class="form-control @error('password') 
                                is-invalid @enderror" name="password" 
                                required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Esqueceu sua palavra-passe? recuperar conta.
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <a href="/register">Ainda não abriste uma conta?
                        <button class="btn mt-4 btn-success form-control">Regista-te agora</button>
                    </a>
                </div>
            </div>
    </div>
</div>
@endsection
