@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('tutorial.index')}}">{{trans('table.tutorials')}}</a>
        </li>
        <li>
            <a href="{{route('section.index')}}">{{trans('table.sections')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.show')}}</strong>
        </li>
    </ol>
    <div>
        {!! $section->name !!}
        {{--{!! img !!}--}}
        {{--{!! is_active !!}--}}
    </div>
    <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection