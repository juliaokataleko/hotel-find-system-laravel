@extends('layouts.app')
@section('title', 'Finanças')
<?php
$ganhos = 0;
$gastos = 0;
foreach($finances as $finance) {
    if($finance->kind == 1 || $finance->kind == 2) {
        $ganhos += $finance->valueM;
    } else {
        $gastos += $finance->valueM;
    }
}

$saldoTotal = $ganhos - $gastos;
?>

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

        <div class="col-md-12">
            <h4 class="display-6">Contas</h4>   
            <a href="{{ route('finances.create')}}" class="form-control btn-success">Adicionar movimento</a> 
            <br>
        </div>

        <div class="col-md-4">
            <div class="card p-4 mb-3 text-danger">
                Passivos: {{number_format($gastos, 2, ',','.')}} Akz
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 mb-3 text-success">
                Receitas: 1{{number_format($ganhos, 2, ',','.')}} Akz
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 mb-3 text-primary">
                Saldo Total: {{number_format($saldoTotal, 2, ',','.')}} Akz
            </div>
        </div>

        <div class="col-sm-12">
          <table class="table table-striped">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Tipo</td>
                  <td>Descrição</td>
                  <td>Valor</td>
                  <td>Registado or</td>
                  <td colspan = 2>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($finances as $finance)
                <tr>
                    <td>{{$finance->id}}</td>
                    <td>{{ movimentKind($finance->kind) }}</td>
                    <td>{{$finance->desc}}</td>
                    <td>{{number_format($finance->valueM, 2, ',','.')}} Akz</td>
                    <td>{{$finance->user->name}}</td>
                    <td>
                        <a href="{{ route('finances.edit',$finance->id)}}" class="btn btn-primary">Alterar</a>
                    </td>
                    <td>

                    <button type="button" class="btn btn-danger ml-2" 
                    data-toggle="modal" 
                    data-target="#exampleModalCenter{{$finance->id}}">
                    Eliminar
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$finance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            Deseja eliminar o movimento: {{$finance->id}}?<br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            
                            <form action="{{ route('finances.destroy', $finance->id)}}" method="post">
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
        <div>

            {{$finances->links()}}
        </div>


</div>
@endsection