@extends('layouts.app')
@section('title', 'Editar prato')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o Cardápio: {{ $meal->name }}</h4>
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
      action="{{ route('meals.update', $meal->id) }}">
        @method('PATCH') 
        @csrf
  
        <div class="form-group">    
            <label for="name">Nome do prato:</label>
            <input type="text" class="form-control" name="name" value="{{ $meal->name }}"/>
        </div>
  
        <div class="form-group">    
          <label for="image">Imagem</label>
          <input type="file" class="form-control" name="image"/>
        </div>
  
        <div class="form-group">    
          <label for="desc">Descrição:</label>
          <input type="text" class="form-control" name="desc" value="{{ $meal->desc }}"/>
        </div>
  
        <div class="form-group">    
          <label for="price">Preço:</label>
          <input type="text" class="form-control" name="price" value="{{ $meal->price }}"/>
        </div>
  
        <div class="form-group">    
        <label for="hotel_id">Hotel:</label>
        <select class="form-control" name="hotel_id" id="hotel_id">
            <option value="{{$meal->hotel->id}}">{{$meal->hotel->name}}</option> 
          @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
          @endforeach
        </select>
        </div>
     
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>



  </div>
</div>
</div>
</div>
@endsection