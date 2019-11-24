@extends('layouts.app')
@section('title', 'Adicionar movimento')
@section('content')
<div class="container" style="max-width: 600px;">
<div class="row">
<div class="col-md-12">
    <h4 class="display-6">Adicionar um movimento</h4>
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
      <form method="post" action="{{ route('finances.store') }}">
          @csrf
          <div class="form-group">    
              <label for="desc">Descrição:</label>
              <input type="text" class="form-control" name="desc"/>
          </div>

          <div class="form-group">    
            <label for="valueM">Valor:</label>
            <input type="text" class="form-control" name="valueM"/>
          </div>

          <div class="form-group">    
          <label for="kind">Tipo:</label>
          <select class="form-control" name="kind" id="kind" required>
            <option value="">...Selecionar</option>
            <option value="1">Saldo inicial</option>
            <option value="2">Ganho</option>
            <option value="3">Gastos e Despesas</option>
            <option value="4">Dívidas</option>
          </select>
          </div>
       
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection