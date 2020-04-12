@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('users.index')}}">User</a>
        </li>
        <li class="active">
            <strong>{{__('action.create')}}</strong>
        </li>
    </ol>
    <form class="row" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-6">
            <label for="first_name">{{trans('label.first_name')}}</label>
            <input  class="form-control" name="first_name" id="first_name">
        </div>
        <div class="form-group col-lg-6">
            <label for="last_name">{{trans('label.last_name')}}</label>
            <input  class="form-control" name="last_name" id="last_name">
        </div>
        <div class="form-group col-lg-6">
            <label for="email">{{trans('label.email')}}</label>
            <input  class="form-control" name="email" id="email">
        </div>
        <div class="form-group col-lg-6">
            <label for="phone_number">{{trans('label.phone_number')}}</label>
            <input  class="form-control" name="phone_number" id="phone_number">
        </div>
        <div class="form-group col-lg-6">
            <label for="birthday">{{trans('label.birthday')}}</label>
            <input type="datetime" class="form-control" name="birthday" id="birthday">
        </div>
        <div class="form-group col-lg-6">
            <label for="slack_webhook_url">{{trans('label.slack_webhook_url')}}</label>
            <input  class="form-control" name="slack_webhook_url" id="slack_webhook_url">
        </div>
        <div class="form-group col-lg-12">
            <label for="address">{{trans('label.address')}}</label>
            <textarea  class="form-control ckeditor" name="address" id="address"></textarea>
        </div>
        <div class="form-group col-lg-12">
            <label for="avatar">{{trans('label.avatar')}}</label>
            <input type="file" class="form-control" name="avatar" id="avatar">
        </div>
        <div class="form-group col-lg-6">
            <label for="active">{{trans('label.active')}}</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active" id="active">
                </label>
            </div>
        </div>
        <div class="form-group col-lg-6">
            <label for="sex">{{trans('label.sex')}}</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="sex" id="sex">
                </label>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <select name="role_ids[]" id="role_ids" class="form-control" multiple>
                @foreach($roleCompose as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-12">
            <button class="btn btn-primary">{{trans('button.done')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
@endsection
@push('js')
    <script>
        Menu('#ACLMenu', '#userMenu')
    </script>
@endpush