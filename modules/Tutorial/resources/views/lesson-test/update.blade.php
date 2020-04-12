@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('lesson-test.index')}}">{{trans('table.lesson_tests')}}</a>
            </li>
            <li class="active">
                <strong>{{trans('action.update')}}</strong>
            </li>
        </ol>

        <form action="{{route('lesson-test.update', $lessonTest->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-4">
                <label for="tutorial_id">{{trans('label.tutorial_id')}}</label>
                <select class="form-control" name="tutorial_id" id="tutorial_id">
                    <option value=""></option>
                    @foreach($tutorialCompose as $id => $name)
                        <option value="{{$id}}" {{$id !== $tutorial_id ?: 'selected' }}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label for="lesson_id">{{trans('label.section_id')}}</label>
                <select class="form-control" name="section_id" id="section_id">
                    @foreach($sectionList as $id => $name)
                        <option value="{{$id}}" {{$id !== $section_id ?: 'selected' }}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label for="lesson_id">{{trans('label.lesson_id')}}</label>
                <select required class="form-control" name="lesson_id" id="lesson_id">
                    @foreach($lessonList as $id => $name)
                        <option value="{{$id}}" {{$id !== $lessonTest->section_id ?: 'selected' }}>{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-12">
                <label for="questions">{{trans('label.questions')}}</label>
                <textarea class="form-control Question" name="question" id="question">{!! $lessonTest->question !!}</textarea>
            </div>

            <div class="form-group col-lg-12">
                <label for="">{{trans('label.reply')}}</label>
                @for($i=1; $i<=4; $i++)
                    <div class="form-group input-group {{$reply = 'reply' . $i}} ">
                        <input  required value="{{$lessonTest->$reply}}" class="form-control"
                               name="{{$reply}}">
                        <span class="input-group-addon">
                        <input type="radio" name="answer" {{$lessonTest->answer === $i ? 'checked' : ''}} id="answer"
                               value="{{$i}}">
                    </span>
                    </div><!-- /input-group -->
                @endfor
            </div>

            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" {{ $lessonTest->is_active === 1 ? 'checked' : ''  }} value="1"
                               name="is_active" id="is_active">
                    </label>
                </div>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
            <input type="hidden" value="{{route('section.list')}}" id="sectionListRoute">
            <input type="hidden" value="{{route('lesson.list')}}" id="lessonListRoute">
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({ element: $(".Question")[0]});
    </script>

    <script src="{{asset('build/forceSelect.js?v=0')}}"></script>
    <script src="{{asset('build/tutorial.js?v=0')}}"></script>
    <script>
        Menu('#eLearnMenu', '#lessonTestMenu')
    </script>
@endpush