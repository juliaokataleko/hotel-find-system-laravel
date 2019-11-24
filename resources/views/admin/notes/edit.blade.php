@extends('layouts.app')
@section('title', 'Editar nota')
@section('content')
<div class="container" style="max-width: 600px;">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar a nota: {{ $note->id }}</h4>
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
    <form method="post" action="{{ route('notes.update', $note->id) }}">
        @method('PATCH') 
        @csrf

        <div class="form-group">    
            <label for="note">Escreva alugma coisa:</label>
            <textarea class="form-control" name="note">{{$note->note}}</textarea>
        </div>
          <button type="submit" class="btn btn-primary-outline">Actualizar</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection