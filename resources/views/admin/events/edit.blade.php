@extends('layouts.app')
@section('title', 'Editar evento')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o evento: {{ $event->name }}</h4>
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
      action="{{ route('events.update', $event->id) }}">
        @method('PATCH') 
        @csrf
        
        <div class="form-group">    
            <label for="name">Título do evento:</label>
            <input type="text" class="form-control" name="name" value="{{ $event->name }}"/>
        </div>
  
        <div class="form-group">    
          <label for="image">Imagem</label>
          <input type="file" class="form-control" name="image"/>
        </div>
  
        <div class="form-group">    
          <label for="desc">Descrição:</label>
          <input type="text" class="form-control" name="desc" value="{{ $event->desc }}"/>
        </div>
  
        <div class="form-group">    
          <label for="desc">Data e Hora:</label>
          <input type="datetime-local" class="form-control" 
          name="dateevent" value="{{ date('Y-m-d\TH:i', strtotime($event->dateevent))}}"/>
        </div>
  
        <div class="form-group">    
          <label for="price">Preço:</label>
          <input type="text" class="form-control" name="price" value="{{ $event->price }}"/>
        </div>
  
        <div class="form-group">    
        <label for="hotel_id">Hotel:</label>
        <select class="form-control" name="hotel_id" id="hotel_id">
          <option value="{{ $event->hotel->id }}">
            {{$event->hotel->name}}
          </option>
          @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
          @endforeach
        </select>
        </div>
  
        <div class="form-group">    
        <label for="open">Status</label>
        <select class="form-control" name="status" id="status">
          <option value="{{ $event->status }}">
            @if ($event->status == 1)
              Realizado
              @else
              Por se realizar
          @endif</option>
          <option value="0">Por se realizar</option>
          <option value="1">Realizado</option>
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>



  </div>
</div>
</div>
</div>
@endsection