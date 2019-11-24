@extends('layouts.app')
@section('title', 'Pagamentos')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
        </div>

        <div class="col-sm-12">
            <h4 class="display-6">Pagamentos</h4>   
            <a href="{{ route('payments.create')}}" class="form-control btn-success">Adicionar pagamento</a> 
            <br>
            @if ($payments->count() > 0)
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <td>ID</td>
                          <td>Hotel</td>
                          <td>Data de pagamento</td>
                          <td>Data de expiração</td>
                          <td>por</td>
                          <td colspan = 2>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
        
                        @foreach($payments as $payment)
                        <tr>
                            <td>
                                <img src="{{asset($payment->doc)}}" 
                                class="card-img-top" style="width:100px" 
                                alt="" srcset="">
                            </td>
                            <td>{{$payment->hotel->name}}</td>
                            <td>{{$payment->datestart}}</td>
                            <td>{{$payment->datefinish}}</td>
                            <td>{{$payment->user->name}}</td>
                            <td>
                                <a href="{{ route('payments.edit',$payment->id)}}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
        
                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" 
                            data-target="#exampleModalCenter{{$payment->id}}">
                            Eliminar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                        Atenção</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Deseja eliminar: {{$payment->name}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    <form action="{{ route('payments.destroy', $payment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Excluir</button>
                                    </form>
                
                                </div>
                                </div>
                            </div>
                            </div>
        
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
            @endif
          
        <div>

            {{$payments->links()}}
        </div>


</div>
@endsection