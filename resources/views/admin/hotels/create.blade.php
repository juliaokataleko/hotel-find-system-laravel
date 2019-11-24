@extends('layouts.app')
@section('title', 'Adicionar Hotél')
@section('content')
<div class="container" style="max-width: 600px;">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar Hotel</h4>
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
      <form autocomplete="off" enctype="multipart/form-data" 
      method="post" action="{{ route('hotels.store') }}">
          @csrf

          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="name" placeholder="Nome"/>
            </div>
            <div class="form-group col-md-6">
                <input type="file" class="form-control" name="image"/>
            </div>

            <div class="form-group col-md-12">
              <input type="text" class="form-control" name="slug" placeholder="Endereço no sistema"/>
            </div>

            <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="Endereço" name="address"/>
            </div>
            <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Correio electrónico"/>
            </div>

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="phone1" placeholder="Telefone"/>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="phon2" placeholder="Outro telefone"/>
            </div>

          </div>


          <div class="form-group">    
              <label for="facebook">Facebook:</label>
              <input type="text" class="form-control" name="facebook"/>
          </div>

          <div class="form-group">    
              <label for="instagram">Instagram:</label>
              <input type="text" class="form-control" name="instagram"/>
          </div>

          <div class="form-group">    
            <label for="website">Website:(Opcional)</label>
            <input type="url" class="form-control" name="website"/>
          </div>

          <div class="form-group">    
          <label for="province_id">Província:</label>
          <select class="form-control" name="province_id" id="province_id" required>
            <option value="">...Selecionar</option>
            @foreach ($provinces as $province)
              <option value="{{$province->id}}">{{$province->name}}</option>  
            @endforeach
          </select>
          </div>

          <div class="form-group">    
          <label for="city_id">Cidade:</label>
          <select class="form-control" name="city_id" id="city_id">
            
          </select>
          </div>

          <div class="form-group">    
              <label for="category">Estrelas:</label>
              <select class="form-control" name="category" id="category" required>
                <option value="">...Selecionar uma categoria</option>  
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">3</option>
                <option value="1">4</option>
                <option value="1">5</option>
              </select>
              </div>

          <div class="form-group">    
          <label for="about">Sobre o Hotel</label>
          <textarea class="form-control" name="about" id="about"></textarea>
            
          </div>

          <div class="form-group">    
              <label for="about">Mapa</label>
              <textarea class="form-control" name="map" id="map"></textarea>
          </div>

          <button type="submit" 
          class="btn btn-primary mb-5">Registar Hotel</button>
          
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