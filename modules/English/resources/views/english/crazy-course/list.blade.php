@extends('en::layouts.app')
@section('content')
    <ol class="breadcrumb bc-1">
        <li>
            <a href="{{route('english.index')}}">
                <i class="fa fa-language"></i> Crazy English
            </a>
        </li>
        {{--<li>--}}
            {{--<a href="{{route('crazy-course.list', $crazyCourse->id)}}">--}}
                {{--<i class="fa fa-list"></i> {{$crazyCourse['name']}}--}}
            {{--</a>--}}
        {{--</li>--}}
    </ol>
    <h1>{{$crazyCourse['name']}}</h1>
    <p class="text-info">
        <b>{!! $crazyCourse->description !!}</b>
    </p>
    <div class="panel panel-success">
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Lesson</th>
                    <th class="hidden-xs">Times</th>
                    <th class="hidden-xs">AVG score</th>
                    <th>Read</th>
                    <th class="text-right hidden-xs">Times</th>
                    <th class="text-right hidden-xs">AVG score</th>
                    <th class="text-right">Writing</th>
                </tr>
                </thead>
                <tbody>
                @foreach($crazyList as $id => $name)
                    <tr>
                        <td>
                            {{$name}}
                        </td>
                        <td class="hidden-xs">{{$testCounts[$id]}}</td>
                        <td class="hidden-xs">{{$avgScores[$id]}}</td>
                        <td>
                            <a href="{{route('test.crazy.reading', $id)}}" title="Lesson Reading: {{$name}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td class="text-right hidden-xs">{{$testWriteCounts[$id]}}</td>
                        <td class="text-right hidden-xs">{{$avgWriteScores[$id]}}</td>
                        <td class="text-right">
                            <a href="{{route('test.crazy.writing', $id)}}" title="Lesson Writing: {{$name}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('en::english.components.courses.crazy')
@endsection
