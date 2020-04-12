@extends('io::layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Chat room</h3>
            </div>
            <div class="panel-body">
                <div class="list-group" id="messageList" data-user-id="{{auth()->id()}}">
                    @foreach($messages['data'] as $message)
                        @if(auth()->id() === $message['from'])
                            <div id="{{$message['id']}}" class="text-right form-group text-info">
                                <strong>{{$message['content']}}</strong>
                            </div>
                        @else
                            <div id="{{$message['id']}}" class="form-group">
                                <p><strong>{{$message['creator']['email']}}</strong></p>
                                <p>{{$message['content']}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="panel-footer">
                <form id="formSendMessage" action="{{route('send')}}" method="post">
                    {{csrf_field()}}
                    <input placeholder="Nhập tin nhắn ..." class="form-control" name="content" id="msgContent">
                </form>
            </div>
        </div>
    </div>
@endsection
