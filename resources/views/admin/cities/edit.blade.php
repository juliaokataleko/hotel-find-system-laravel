@extends('layouts.app')
@section('title', 'Editar cidade')
@section('content')
<div class="container" style="max-width: 600px;">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar a cidade de {{ $city->name }}</h4>
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
    <form method="post" action="{{ route('cities.update', $city->id) }}">
        @method('PATCH') 
        @csrf
          <div class="form-group">    
              <label for="first_name">Nome:</label>
              <input type="text" class="form-control" name="name" value="{{ $city->name }}"/>
          </div>

          <div class="form-group">    
          <label for="first_name">Província: {{ $city->province->name }}</label>
          <select class="form-control" name="province_id" id="province">
              <option value="{{$city->province->id}}">{{$city->province->name}}</option> 
            @foreach ($provinces as $province)
              <option value="{{$province->id}}">{{$province->name}}</option>  
            @endforeach
          </select>
          </div>
       
          <button type="submit" class="btn btn-primary-outline">Actualizar</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection