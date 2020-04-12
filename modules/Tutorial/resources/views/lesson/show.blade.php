@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('lesson.index')}}">{{__('table.lessons')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.show')}}</strong>
        </li>
    </ol>
    <div>
        {!! $lesson->title !!}
        {!!  $lesson->intro !!}
        {!!  $lesson->content !!}
        {{--{!!  $lesson->section_id !!}--}}
        {{--{!!  $lesson->views !!}--}}
        {{--{!!  $lesson->last_view !!}--}}
        {{--{!!  $lesson->createName() !!}--}}
        {{--{!!  $lesson->updateName() !!}--}}
    </div>
@endsection