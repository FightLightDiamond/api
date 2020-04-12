@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('verify-users.index')}}">{{trans('table.verify_users')}}</a>
    </li>
    <li class="active">
        <strong>{{__('action.update')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('verify-users.update', $verifyUser->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group col-lg-12">
    <label for="email">{{trans('label.email')}}</label>
    <div class="checkbox">
        <label>
            <input required type="checkbox" {{$verifyUser->email !== 1 ?: 'checked'}} name="email" id="email" value="1">
        </label>
    </div>
</div>
<div class="form-group col-lg-12">
    <label for="phone">{{trans('label.phone')}}</label>
    <div class="checkbox">
        <label>
            <input required type="checkbox" {{$verifyUser->phone !== 1 ?: 'checked'}} name="phone" id="phone" value="1">
        </label>
    </div>
</div>
<div class="form-group col-lg-12">
    <label for="otp_verified">{{trans('label.otp_verified')}}</label>
    <div class="checkbox">
        <label>
            <input required type="checkbox" {{$verifyUser->otp_verified !== 1 ?: 'checked'}} name="otp_verified" id="otp_verified" value="1">
        </label>
    </div>
</div>
<div class="form-group col-lg-12">
    <label for="google_authentication">{{trans('label.google_authentication')}}</label>
    <input required class="form-control" name="google_authentication" id="google_authentication" value="{{$verifyUser->google_authentication}}">
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
        Menu('#ACLMenu', '#verifyUserMenu')
    </script>
@endpush
