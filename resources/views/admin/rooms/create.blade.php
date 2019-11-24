@extends('layouts.app')

@section('title', 'Adicionar Quarto')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar quarto</h4>
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
      <form enctype="multipart/form-data" method="post" action="{{ route('rooms.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Título do quarto:</label>
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
          <label for="open">Disponibilidade</label>
          <select class="form-control" name="open" id="open">
            <option value="1">Disponível</option>
            <option value="0">Indisponível</option>
          </select>
          </div>
       
          <button type="submit" class="btn btn-primary mb-5">Add</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection