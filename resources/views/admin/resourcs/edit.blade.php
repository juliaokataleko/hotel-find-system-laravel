@extends('layouts.app')
@section('title', 'Editar recurso')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o recurso: {{ $resourc->name }}</h4>
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
   
      <form enctype="multipart/form-data" method="post" 
      action="{{ route('resourcs.update', $resourc->id) }}">
        @method('PATCH') 
        @csrf
  
        <div class="form-group">    
            <label for="name">Nome do recurso:</label>
            <input type="text" class="form-control" name="name" value="{{$resourc->name}}"/>
        </div>
  
        <div class="form-group">    
        <label for="hotel_id">Hotel:</label>
        <select class="form-control" name="hotel_id" id="hotel_id">
            <option value="{{$resourc->hotel->id}}">{{$resourc->hotel->name}}</option> 
          @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
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