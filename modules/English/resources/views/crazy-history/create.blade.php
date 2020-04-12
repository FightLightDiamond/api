@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admin.crazies.history.index')}}">{{trans('table.crazy_histories')}}</a>
    </li>
    <li class="active">
        <strong>{{__('action.create')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('admin.crazies.history.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-6">
    <label for="crazy_id">{{trans('label.crazy_id')}}</label>
    <input required class="form-control" name="crazy_id" id="crazy_id">
</div>

<div class="form-group col-lg-12">
    <label for="score">{{trans('label.score')}}</label>
    <textarea required class="form-control ckeditor" name="score" id="score"></textarea>
</div>
<div class="form-group col-lg-6">
    <label for="type">{{trans('label.type')}}</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" required checked value="1" name="type" id="type">
        </label>
    </div>
</div>


        <div class="col-lg-12">
            <button class="btn btn-primary">{{trans('button.done')}}</button>
            <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
            <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
</div>
@endsection