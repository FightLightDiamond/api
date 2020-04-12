@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('tutorial-test.index')}}">{{__('table.tutorial_tests')}}</a>
            </li>
            <li class="active">
                <strong>{{__('action.update')}}</strong>
            </li>
        </ol>
        <form action="{{route('tutorial-test.update', $tutorialTest->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-12">
                @include('tut::layouts.components.tutorial', ['id' => @$tutorialTest->tutorial->id])
            </div>
            <div class="form-group col-lg-12">
                <label for="question">{{trans('label.question')}}</label>
                <textarea class="form-control" name="question" id="question">{{$tutorialTest->question}}</textarea>
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
            <div class="col-lg-12 form-group">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default isBack">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        Menu('#eLearnMenu', '#tutorialTesttMenu')
    </script>
@endpush