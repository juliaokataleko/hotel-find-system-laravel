@extends('layouts.app')
@section('title', 'Editar contacto')
@section('content')
<div class="container" style="max-width: 600px;">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o contacto {{ $contact->name }}</h4>
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
    <form method="post" action="{{ route('contacts.update', $contact->id) }}">
        @method('PATCH') 
        @csrf

          <div class="form-group">    
              <label for="first_name">Nome:</label>
              <input type="text" class="form-control" name="name" value="{{ $contact->name }}"/>
          </div>

          <div class="form-group">    
              <label for="phone">Telefone:</label>
              <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}"/>
          </div>

          <div class="form-group">    
              <label for="phone2">Outro telefone:</label>
              <input type="text" class="form-control" name="phone2" value="{{ $contact->phone2 }}"/>
          </div>

          <div class="form-group">    
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $contact->email }}"/>
          </div>

          <div class="form-group">    
              <label for="email2">Outro email:</label>
              <input type="text" class="form-control" name="email2" value="{{ $contact->email2 }}"/>
          </div>
       
          <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection