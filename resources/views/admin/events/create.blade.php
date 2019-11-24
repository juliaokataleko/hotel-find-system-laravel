@extends('layouts.app')
@section('title', 'Adicionar evento')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar Evento</h4>
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
    <form enctype="multipart/form-data" method="post" action="{{ route('events.store') }}">
      @csrf
      <div class="form-group">    
          <label for="name">Título do evento:</label>
          <input type="text" class="form-control" name="name"/>
      </div>

      <div class="form-group">    
        <label for="image">Imagem</label>
        <input type="file" class="form-control" name="image"/>
      </div>

      <div class="form-group">    
        <label for="desc">Descrição:</label>
        <input type="text" class="form-control" name="desc"/>
      </div>

      <div class="form-group">    
        <label for="desc">Data e Hora:</label>
        <input type="datetime-local" class="form-control" name="dateevent"/>
      </div>

      <div class="form-group">    
        <label for="price">Preço:</label>
        <input type="text" class="form-control" name="price"/>
      </div>

      <div class="form-group">    
      <label for="hotel_id">Hotel:</label>
      <select class="form-control" name="hotel_id" id="hotel_id">
        @foreach ($hotels as $hotel)
          <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
        @endforeach
      </select>
      </div>

      <div class="form-group">    
      <label for="open">Status</label>
      <select class="form-control" name="status" id="status">
        <option value="0">Por se realizar</option>
        <option value="1">Realizado</option>
        
      </select>
      </div>

      <button type="submit" class="btn btn-primary mb-5">Registar</button>
      </form>
  </div>
</div>
</div>
</div>

<script>
  //$('#example').append("Texto para aquele div");
  $('#province_id').change(function(e) {
      console.log(e);
      const province_id = e.target.value;
      // ajax
      $.get('/ajax-city?province_id=' + province_id, function(data){
        //console.log(data);
        $('#city_id').empty();
        $.each(data, function(index, cityObj) {
          $('#city_id').append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
        });
      });
    })
</script>

@endsection