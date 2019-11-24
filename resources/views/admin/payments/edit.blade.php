@extends('layouts.app')
@section('title', 'Editar pagamento')
@section('content')
<div class="container">

 <div class="row">
 <div class="col-md-12">
    <h4 class="display-6">Editar o pagamento do: {{ $payment->hotel->name }}</h4>
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
   
      <form enctype="multipart/form-data" method="post" 
      action="{{ route('payments.update', $payment->id) }}">
        @method('PATCH') 
        @csrf
  
        <div class="form-group">    
          <label for="doc">Documento Digitalizado</label>
          <input type="file" class="form-control" name="doc"/>
        </div>
  
        <div class="form-group">    
          <label for="dateassign">Data de pagamento:</label>
          <input type="datetime-local" class="form-control" 
          value="{{ date('Y-m-d\TH:i', strtotime($payment->datestart))}}" name="datestart"/>
        </div>

        <div class="form-group">    
          <label for="datefinish">Data de expiração:</label>
          <input type="datetime-local" class="form-control" 
          value="{{ date('Y-m-d\TH:i', strtotime($payment->datefinish))}}" name="datefinish"/>
        </div>
  
        <div class="form-group">    
        <label for="hotel_id">Hotel:</label>
        <select class="form-control" name="hotel_id" id="hotel_id">
            <option value="{{$payment->hotel->id}}">{{$payment->hotel->name}}</option> 
          @foreach ($hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->name}}</option>  
          @endforeach
        </select>
        </div>
     
        <button type="submit" class="btn btn-primary-outline">Actualizar</button>
    </form>



  </div>
</div>
</div>
</div>
@endsection