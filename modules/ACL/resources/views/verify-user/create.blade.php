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
        <strong>{{__('action.create')}}</strong>
    </li>
</ol>
<div class="row">
    <form action="{{route('verify-users.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-12">
    <label for="email">{{trans('label.email')}}</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" required checked value="1" name="email" id="email">
        </label>
    </div>
</div>

<div class="form-group col-lg-12">
    <label for="phone">{{trans('label.phone')}}</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" required checked value="1" name="phone" id="phone">
        </label>
    </div>
</div>

<div class="form-group col-lg-12">
    <label for="otp_verified">{{trans('label.otp_verified')}}</label>
    <div class="checkbox">
        <label>
            <input type="checkbox" required checked value="1" name="otp_verified" id="otp_verified">
        </label>
    </div>
</div>

<div class="form-group col-lg-12">
    <label for="google_authentication">{{trans('label.google_authentication')}}</label>
    <input required class="form-control" name="google_authentication" id="google_authentication">
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