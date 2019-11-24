@extends('layouts.app')
@section('title', 'Adicionar contrato')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar contracto</h4>
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
    <form enctype="multipart/form-data" method="post" action="{{ route('contracts.store') }}">
      @csrf
      <div class="form-group">    
        <label for="doc">Documento Digitalizado</label>
        <input type="file" class="form-control" name="doc"/>
      </div>

      <div class="form-group">    
        <label for="dateassign">Data de assinatura:</label>
        <input type="datetime-local" class="form-control" name="dateassign"/>
      </div>

      <div class="form-group">    
      <label for="hotel_id">Hotel:</label>
      <select class="form-control" name="hotel_id" id="hotel_id">
        @foreach ($hotels as $hotel)
          <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
        @endforeach
      </select>
      </div>

      <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
</div>
</div>

@endsection