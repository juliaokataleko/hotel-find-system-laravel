@extends('layouts.app')
@section('title', 'Visitas')
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
            <h4 class="display-6">Visitas </h4>
            <div class="row">
                <div class="col-md-4 border p-4 text-center text-info">
                    Total de sempre: {{$allVisits->count()}}
                </div>
                <div class="col-md-4 border p-4 text-center text-danger">
                    Esta semana: {{$guestts->count()}}
                </div>
                <div class="col-md-4  border p-4 text-center text-success">
                    Hoje: {{$guestts->count()}}
                </div>

            </div>  
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                      <td>ID</td>
                      <td>IP</td>
                      <td>Hotel</td>
                      <td>Hora</td>
                      <td>Plataforma</td>
                      <td colspan = 2>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guestts as $guestt)
                    <tr>
                        <td>{{$guestt->id}}</td>
                        <td>{{$guestt->ip}}</td>
                        <td>{{$guestt->hotel->name}}</td>
                        <td>{{dateProcess($guestt->created_at)}}</td>
                        <td>{{choosePlatform($guestt->platform)}}</td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

        <div>

            {{$guestts->links()}}
        </div>


</div>
@endsection