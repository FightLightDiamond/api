@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('messages.index')}}">{{trans('table.messages')}}</a>
    </li>
    <li class="active">
        <strong>{{__('action.update')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('messages.update', $message->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group col-lg-12">
    <label for="author">{{trans('label.author')}}</label>
    <input required class="form-control" name="author" id="author" value="{{$message->author}}">
</div>
<div class="form-group col-lg-12">
    <label for="content">{{trans('label.content')}}</label>
    <textarea class="form-control" name="content" id="content">{{$message->content}}</textarea>
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

@push('js')
    <script>
        Menu('#IOMenu', '#messageMenu')
    </script>
@endpush
