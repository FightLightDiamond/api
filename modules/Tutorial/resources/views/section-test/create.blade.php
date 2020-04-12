@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="/">_name_</a>
            </li>
            <li class="active">
                <strong>Tables</strong>
            </li>
        </ol>

        <form action="{{route('section-test.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group col-lg-6">
                <label for="section_id">{{trans('label.section_id')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="section_id" id="section_id">
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <label for="questions">{{trans('label.questions')}}</label>
                <textarea class="form-control ckeditor" name="questions" id="questions"></textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="reply1">{{trans('label.reply1')}}</label>
                <input  class="form-control" name="reply1" id="reply1">
            </div>
            <div class="form-group col-lg-6">
                <label for="reply2">{{trans('label.reply2')}}</label>
                <input  class="form-control" name="reply2" id="reply2">
            </div>
            <div class="form-group col-lg-6">
                <label for="reply3">{{trans('label.reply3')}}</label>
                <input  class="form-control" name="reply3" id="reply3">
            </div>
            <div class="form-group col-lg-6">
                <label for="reply4">{{trans('label.reply4')}}</label>
                <input  class="form-control" name="reply4" id="reply4">
            </div>
            <div class="form-group col-lg-6">
                <label for="answer">{{trans('label.answer')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="answer" id="answer">
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_active" id="is_active">
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="created_by">{{trans('label.created_by')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="created_by" id="created_by">
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="updated_by">{{trans('label.updated_by')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="updated_by" id="updated_by">
                    </label>
                </div>
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        Menu('#eLearnMenu', '#sectiontTestMenu')
    </script>
@endpush