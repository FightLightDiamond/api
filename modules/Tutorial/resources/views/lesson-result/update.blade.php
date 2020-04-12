@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('lesson-result.index')}}">{{__('table.lesson_results')}}</a>
            </li>
            <li class="active">
                <strong>{{__('action.update')}}</strong>
            </li>
        </ol>
        <form action="{{route('lesson-result.update', $lessonResult->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-6">
                <label for="created_by">{{trans('label.created_by')}}</label>
                <input type="number" class="form-control" name="created_by" id="created_by"
                       value="{{$lessonResult->created_by}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="lesson_id">{{trans('label.lesson_id')}}</label>
                <input type="number" class="form-control" name="lesson_id" id="lesson_id"
                       value="{{$lessonResult->lesson_id}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="score">{{trans('label.score')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="score" id="score" value="{{$lessonResult->score}}">
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
        Menu('#eLearnMenu', '#lessonResultMenu')
    </script>
@endpush