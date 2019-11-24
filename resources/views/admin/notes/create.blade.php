@extends('layouts.app')
@section('title', 'Adicionar nota')
@section('content')
<div class="container" style="max-width: 600px;">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar nota</h4>
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
      <form method="post" action="{{ route('notes.store') }}">
          @csrf
          <div class="form-group">    
              <label for="note">Escreva alugma coisa:</label>
              <textarea class="form-control" name="note"></textarea>
          </div>

          <button type="submit" class="btn btn-primary form-control">Adicinar nota</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection