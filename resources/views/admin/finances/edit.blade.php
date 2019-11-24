@extends('layouts.app')
@section('title', 'Editar dado')
@section('content')
<div class="container" style="max-width: 600px;">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o movimento: {{ $finance->id }}</h4>
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
    <form method="post" action="{{ route('finances.update', $finance->id) }}">
        @method('PATCH') 
        @csrf
        
          <div class="form-group">    
              <label for="desc">Descrição:</label>
              <input type="text" class="form-control" name="desc" value="{{ $finance->desc }}"/>
          </div>

          <div class="form-group">    
            <label for="valueM">Valor:</label>
            <input type="text" class="form-control" name="valueM" value="{{ $finance->valueM }}"/>
          </div>

          <div class="form-group">    
          <label for="kind">Tipo:</label>
          <select class="form-control" name="kind" id="kind" required>
            <option value="{{ $finance->kind }}">{{ movimentKind($finance->kind) }}</option>
            <option value="1">Saldo inicial</option>
            <option value="2">Ganho</option>
            <option value="3">Gastos e Despesas</option>
          </select>
          </div>
       
          <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
  </div>
</div>
</div>
</div>
@endsection