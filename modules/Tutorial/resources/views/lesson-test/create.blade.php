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
                <strong>{{trans('action.create')}}</strong>
            </li>
        </ol>

        <form action="{{route('lesson-test.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @if(request('lesson_id'))
                <input type="hidden" name="lesson_id" value="{{request('lesson_id')}}">
            @else
                <div class="form-group col-lg-4">
                    @include('tut::layouts.components.tutorial')
                </div>
                <div class="form-group col-lg-4">
                    @include('tut::layouts.components.section')
                </div>
                <div class="form-group col-lg-4">
                    @include('tut::layouts.components.lesson')
                </div>
            @endif

            <div class="form-group col-lg-12">
                <label for="question">{{trans('label.question')}}</label>
                <textarea class="form-control Question" name="question" id="question"></textarea>
            </div>
            <div class="form-group col-lg-12">
                <label for="reply">{{trans('label.reply')}}</label>
                @for($i=1; $i<=4; $i++)
                    <div class="form-group">
                        <div class="input-group">
                            <input  class="form-control" name="reply{{$i}}">
                            <span class="input-group-addon">
                                <input type="radio" name="answer" id="answer" value="{{$i}}">
                            </span>
                        </div><!-- /input-group -->
                    </div>
                @endfor
            </div>

            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked value="1" name="is_active" id="is_active">
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
        <input type="hidden" value="{{route('lesson.list')}}" id="lessonListRoute">
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