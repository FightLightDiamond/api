@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Message
                    </div>
                    <div class="card-body" id="app">
                        <chat-app :user="{{auth()->user()}}"></chat-app>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="//{{request()->getHost()}}:6001/socket.io/socket.io.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
@endpush
