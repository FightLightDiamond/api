@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('tutorial-result.index')}}">{{__('table.tutorial_results')}}</a>
            </li>
            <li class="active">
                <strong>Table</strong>
            </li>
        </ol>
        <form action="{{route('tutorial-result.update', $tutorialResult->id)}}" method="POST"
              enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-6">
                <label for="created_by">{{trans('label.created_by')}}</label>
                <input  readonly class="form-control" name="created_by" id="created_by"
                       value="{{$tutorialResult->creatorName()}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="tutorial_id">{{trans('label.tutorial_id')}}</label>
                <input type="name" readonly class="form-control" name="tutorial_id" id="tutorial_id"
                       value="{{$tutorialResult->tutorial ? $tutorialResult->tutorial->name : ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="score">{{trans('label.score')}}</label>
                <input class="form-control" type="number" name="score" id="score" value="{{$tutorialResult->score}}">
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
        Menu('#eLearnMenu', '#tutorialResultMenu')
    </script>
@endpush