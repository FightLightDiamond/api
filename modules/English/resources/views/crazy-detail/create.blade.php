@extends('layouts.app')
@section('content')
<div class="row">
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.crazies.detail.index')}}">{{trans('table.crazy_details')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.create')}}</strong>
        </li>
    </ol>

    <form action="{{route('admin.crazies.detail.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-6">
    <label for="crazy_id">{{trans('label.crazy_id')}}</label>
    <input type="number" class="form-control" name="crazy_id" id="crazy_id">
</div>
<div class="form-group col-lg-6">
    <label for="no">{{trans('label.no')}}</label>
    <input type="number" class="form-control" name="no" id="no">
</div>
<div class="form-group col-lg-6">
    <label for="sentence">{{trans('label.sentence')}}</label>
    <input class="form-control" name="sentence" id="sentence">
</div>

<div class="form-group col-lg-6">
    <label for="meaning">{{trans('label.meaning')}}</label>
    <input class="form-control" name="meaning" id="meaning">
</div>

<div class="form-group col-lg-6">
    <label for="created_by">{{trans('label.created_by')}}</label>
    <input type="number" class="form-control" name="created_by" id="created_by">
</div>
<div class="form-group col-lg-6">
    <label for="updated_by">{{trans('label.updated_by')}}</label>
    <input type="number" class="form-control" name="updated_by" id="updated_by">
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
            <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
</div>
@endsection