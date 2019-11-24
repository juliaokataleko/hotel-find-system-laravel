@extends('layouts.app')
@section('title', 'Editar Hotél')
@section('content')
<div class="container" style="max-width: 600px;">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o hotel {{ $hotel->name }}</h4>
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
    <form method="post" autocomplete="off" 
    enctype="multipart/form-data" action="{{ route('hotels.update', $hotel->id) }}">
        @method('PATCH') 
        @csrf

          <div class="form-group">    
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="name" value="{{ $hotel->name }}"/>
          </div>

          <div class="form-group col-md-12">
            <input type="text" class="form-control" name="slug" 
            placeholder="Endereço no sistema" value="{{ $hotel->slug }}"/>
          </div>

          <div class="form-group">    
            <label for="image">Logo:</label>
            <input type="file" class="form-control" name="image"/>
        </div>

          <div class="form-group">    
              <label for="address">Endereço:</label>
              <input type="text" class="form-control" name="address" value="{{ $hotel->address }}"/>
          </div>

          <div class="form-group">    
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" value="{{ $hotel->email }}"/>
          </div>

          <div class="form-group">    
              <label for="phone">Telefone:</label>
              <input type="text" class="form-control" name="phone1" value="{{ $hotel->phone1 }}"/>
          </div>

          <div class="form-group">    
              <label for="phone2">Telefone 2(Opcional):</label>
              <input type="text" class="form-control" name="phon2" value="{{ $hotel->phone2 }}"/>
          </div>

          <div class="form-group">    
              <label for="facebook">Facebook:</label>
              <input type="text" class="form-control" name="facebook" value="{{ $hotel->facebook }}"/>
          </div>

          <div class="form-group">    
              <label for="instagram">Instagram:</label>
              <input type="text" class="form-control" name="instagram" value="{{ $hotel->instagram }}"/>
          </div>

          <div class="form-group">    
            <label for="website">Website:(Opcional)</label>
            <input type="url" class="form-control" name="website" value="{{ $hotel->website }}"/>
          </div>

          <div class="form-group">    
          <label for="province_id">Província:</label>
          <select class="form-control" name="province_id" id="province_id">
              <option value="{{$hotel->province->id}}">{{$hotel->province->name}}</option>
            @foreach ($provinces as $province)
              <option value="{{$province->id}}">{{$province->name}}</option>  
            @endforeach
          </select>
          </div>

          <div class="form-group">    
          <label for="city_id">Cidade:</label>
          <select class="form-control" name="city_id" id="city_id">
              <option value="{{$hotel->city->id}}">{{$hotel->city->name}}</option>
          </select>
          </div>

          <div class="form-group">    
          <label for="about">Sobre o Hotel</label>
          <textarea class="form-control" name="about" id="about">{{$hotel->about}}</textarea>
            
          </div>

          <div class="form-group">    
              <label for="about">Mapa</label>
              <textarea class="form-control" name="map" id="map">{{$hotel->map}}</textarea>
          </div>

       
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <br><br>
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