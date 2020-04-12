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
            <a href="{{route('section.index')}}?tutorial_id={{$tutorial_id}}">{{trans('table.sections')}}</a>
        </li>
        <li>
            <a href="{{route('lesson.index')}}">{{trans('table.lessons')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('lesson.update', $lesson->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-6">
                <label for="title">{{trans('label.title')}}</label>
                <input  value="{{$lesson->title}}" class="form-control" name="title" id="title">
            </div>
            <div class="form-group col-lg-3">
                <label for="title">{{trans('label.tutorial_id')}}</label>
                <select class="form-control selectFilter" name="tutorial_id" id="tutorial_id">
                    <option value=""></option>
                    @foreach($tutorialCompose as $id => $name)
                        <option {{$tutorial_id === $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-3">
                <label for="title">{{trans('label.section_id')}}</label>
                <select class="form-control selectFilter" name="section_id" id="section_id">
                    <option value=""></option>
                    @foreach($sectionList as $id => $name)
                        <option {{$lesson->section_id === $id ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="intro">{{trans('label.intro')}}</label> @imageMan
                <textarea class="form-control Intro" name="intro" id="intro">{!! $lesson->intro !!}</textarea>
            </div>
            <div class="form-group col-lg-12">
                <label for="content">{{trans('label.content')}}</label> @imageMan
                <textarea class="form-control Content" rows="40" name="content" id="content">{{ $lesson->content }}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" {{ $lesson->is_active == 1 ? 'checked' : '' }}
                        name="is_active" id="is_active">
                    </label>
                </div>
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default isBack">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
        <input type="hidden" value="{{route('section.list')}}" id="sectionListRoute">
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="{{asset('build/forceSelect.js?v=0')}}"></script>
    <script src="{{asset('build/tutorial.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#lessonMenu')
        var simplemde = new SimpleMDE({ element: $(".Intro")[0]});
        var simplemdes = new SimpleMDE({ element: $(".Content")[0] });
    </script>
@endpush