@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admins.index')}}">{{trans('table.admins')}}</a>
    </li>
    <li class="active">
        <strong>{{__('action.create')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-12">
    <label for="name">{{trans('label.name')}}</label>
    <input required class="form-control" name="name" id="name">
</div>

<div class="form-group col-lg-12">
    <label for="email">{{trans('label.email')}}</label>
    <input required class="form-control" name="email" id="email">
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

@push('js')
<script>
    Menu('#ACLMenu', '#adaAccountMenu')
</script>
@endpush