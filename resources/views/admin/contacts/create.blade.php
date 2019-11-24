@extends('layouts.app')
@section('title', 'Adicionar contacto')
@section('content')
<div class="container" style="max-width: 600px;">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar contacto</h4>
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
      <form method="post" action="{{ route('contacts.store') }}">
          @csrf
          <div class="form-group">    
              <label for="first_name">Nome:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">    
              <label for="phone">Telefone:</label>
              <input type="text" class="form-control" name="phone"/>
          </div>

          <div class="form-group">    
              <label for="phone2">Outro telefone:</label>
              <input type="text" class="form-control" name="phone2"/>
          </div>

          <div class="form-group">    
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>

          <div class="form-group">    
              <label for="email2">Outro email:</label>
              <input type="text" class="form-control" name="email2"/>
          </div>
       
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection