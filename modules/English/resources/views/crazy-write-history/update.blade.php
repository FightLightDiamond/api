@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('crazy-write-histories.index')}}">{{trans('table.crazy_write_histories')}}</a>
    </li>
    <li class="active">
        <strong>{{__('action.update')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('crazy-write-histories.update', $crazyWriteHistory->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group col-lg-6">
    <label for="crazy_id">{{trans('label.crazy_id')}}</label>
    <input required class="form-control" name="crazy_id" id="crazy_id" value="{{$crazyWriteHistory->crazy_id}}">
</div>
<div class="form-group col-lg-6">
    <label for="score">{{trans('label.score')}}</label>
    <input required type="number" class="form-control" name="score" id="score" value="{{$crazyWriteHistory->score}}">
</div>
<div class="form-group col-lg-6">
    <label for="type">{{trans('label.type')}}</label>
    <div class="checkbox">
        <label>
            <input required type="checkbox" {{$crazyWriteHistory->type !== 1 ?: 'checked'}} name="type" id="type" value="1">
        </label>
    </div>
</div>

        <div class="col-lg-12 form-group">
            <button class="btn btn-primary">{{trans('button.done')}}</button>
            <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
            <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
</div>
@endsection