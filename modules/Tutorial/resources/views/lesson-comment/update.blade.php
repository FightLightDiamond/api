@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('lesson-comment.index')}}">{{__('table.lesson_comments')}}</a>
            </li>
            <li class="active">
                <strong>{{__('action.update')}}</strong>
            </li>
        </ol>
        <form action="{{route('lesson-comment.update', $lessonComment->id)}}" method="POST"
              enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-6">
                <label for="lesson_id">{{trans('label.lesson_id')}}</label>
                <input type="number" class="form-control" name="lesson_id" id="lesson_id"
                       value="{{$lessonComment->lesson_id}}">
            </div>
            <div class="form-group col-lg-12">
                <label for="content">{{trans('label.content')}}</label>
                <textarea class="form-control ckeditor" name="content"
                          id="content">{{$lessonComment->content}}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="create_by">{{trans('label.create_by')}}</label>
                <input type="number" class="form-control" name="create_by" id="create_by"
                       value="{{$lessonComment->create_by}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_active" id="is_active" value="{{$lessonComment->is_active}}">
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
        Menu('#eLearnMenu', '#lessonCommentMenu')
    </script>
@endpush