@extends('layouts.app')
@section('title', 'Editar foto')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar foto</h4>
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
      action="{{ route('photos.update', $photo->id) }}">
        @method('PATCH') 
        @csrf
        <img style="width:100%; max-width: 300px;" src="{{asset($photo->image)}}" alt="{{$photo->desc}}" srcset=""/>
        <div class="form-group">    
            <label for="name">Descrição:</label>
            <input type="text" class="form-control" name="desc" value="{{$photo->desc}}"/>
        </div>
  
        <div class="form-group">    
        <label for="hotel_id">Hotel:</label>
        <select class="form-control" name="hotel_id" id="hotel_id">
          <option value="{{$photo->hotel->id}}">{{$photo->hotel->name}}</option>  
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