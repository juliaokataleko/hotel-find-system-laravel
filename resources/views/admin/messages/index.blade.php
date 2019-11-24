@extends('layouts.app')
@section('title', 'Mensagens')
@section('content')



<div class="container">
<div class="row">
<div class="col-md-12">
    <div class="chat_container">
        <div class="job-box">
            @if (count($messages) > 0)
                
            <div class="inbox-message">
                <ul>
                    @foreach($messages as $message)
                    <li>
                        <a href="#">
                            <div class="message-avatar">
                                <img src="/storage/imgs/user.png" alt="">
                            </div>
                            <div class="message-body">
                                <div class="message-body-heading">
                                    <h5>{{$message->name}} </h5>
                                    <span>{{$message->created_at }}</span>
                                </div>
                                <p>{{$message->message}} <br> Para o {{$message->hotel->name}} </p>
                                __________________ <br>
                                {{$message->email}}
                            </div>
                        </a>
                    </li>
                    @endforeach
                    
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</div>

@endsection