@extends('io::layouts.app')
@section('content')
    <div class="row">
        @foreach($groups as $group)
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            {{$group->name}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($group->users as $user)
                                <li class="list-group-item">
                                    <a href="{{route('spy', $user->id)}}">{{$user->last_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form action="{{route('notify', $group->id)}}" method="POST">
                            {{csrf_field()}}
                            <button class="btn btn-primary btn-xs">Notifier</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
