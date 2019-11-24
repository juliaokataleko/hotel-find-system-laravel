@extends('layouts.app')

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
            <h1>Registo incompleto</h1><br>
            Ainda não estás associado a nenhum Hotel.
        </div>


</div>
@endsection