@extends('layouts.app')
@section('title', 'Galeria')
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
            <h4 class="display-6">Galeria <a href="{{ route('photos.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a> </h4>   
            
            <br>
            
            @if ($photos->count() > 0)
            <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4">
                <img style="width:100%" src="{{asset($photo->image)}}" alt="{{$photo->desc}}" srcset=""/>
                {{$photo->desc}} {{$photo->hotel->name}} <br>
                Por {{$photo->user->name}}
            
                @if($photo->cover == 0)
                <a href="{{ route('photos.edit',$photo->id)}}">Alterar</a>
                <form action="/dashboard/makeCover/{{$photo->id}}" method="get">
                @csrf
                <button class="btn btn-danger" type="submit">Tornar capa</button>
                </form>
                @endif

                <a style="color:red; cursor:pointer" class="" data-toggle="modal" 
                data-target="#exampleModalCenter{{$photo->id}}">
                Eliminar
                </a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    
                    <div class="modal-body">
                        <img style="width:100%" src="{{asset($photo->image)}}" alt="{{$photo->desc}}" srcset=""/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        
                        <form action="{{ route('photos.destroy', $photo->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Excluir</button>
                        </form>
    
                    </div>
                    </div>
                </div>
                </div>
            </div>

            @endforeach
            
            </div>
            @endif
        <div>

            {{$photos->links()}}
        </div>


</div>
@endsection