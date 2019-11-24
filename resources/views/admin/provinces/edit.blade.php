@extends('layouts.app')
@section('title', 'Editar Província')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar a Província {{ $province->name }}</h4>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="post" action="{{ route('provinces.update', $province->id) }}">
        @method('PATCH') 
        @csrf
          <div class="form-group">    
              <label for="first_name">Nome:</label>
              <input type="text" class="form-control" name="name" value="{{ $province->name }}"/>
          </div>
       
          <button type="submit" class="btn btn-primary-outline">Actualizar</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection