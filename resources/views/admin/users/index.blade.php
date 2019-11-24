@extends('layouts.app')
@section('title', 'Usuários registados no sistema')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nome</td>
                        <td>Usuário</td>
                        <td>Email</td>
                        <td>Categoria</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{userCategory($user->role)}}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
    </div>

</div>
@endsection