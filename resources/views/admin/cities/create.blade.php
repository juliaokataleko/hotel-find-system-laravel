@extends('layouts.app')
@section('title', 'Adicionar cidade')
@section('content')
<div class="container" style="max-width: 600px;">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar uma cidade</h4>
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
      <form method="post" action="{{ route('cities.store') }}">
          @csrf
          <div class="form-group">    
              <label for="first_name">Cidade:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">    
          <label for="first_name">Província:</label>
          <select class="form-control" name="province_id" id="province">
            @foreach ($provinces as $province)
              <option value="{{$province->id}}">{{$province->name}}</option>  
            @endforeach
          </select>
          </div>
       
          <button type="submit" class="btn btn-primary-outline">Add</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection