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
            <strong>{{__('action.update')}}</strong>
        </li>
    </ol>
    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data" class="row">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group col-lg-6">
            <label for="first_name">{{trans('label.first_name')}}</label>
            <input class="form-control" name="first_name" id="first_name"
                   value="{{$user->first_name}}">
        </div>
        <div class="form-group col-lg-6">
            <label for="last_name">{{trans('label.last_name')}}</label>
            <input class="form-control" name="last_name" id="last_name"
                   value="{{$user->last_name}}">
        </div>
        <div class="form-group col-lg-6">
            <label for="phone_number">{{trans('label.phone_number')}}</label>
            <input class="form-control" name="phone_number" id="phone_number"
                   value="{{$user->phone_number}}">
        </div>
        <div class="form-group col-lg-6">
            <label for="birthday">{{trans('label.birthday')}}</label>
            <input class="form-control" name="birthday" id="birthday"
                   value="{{$user->birthday}}">
        </div>
        <div class="form-group col-lg-12">
            <label for="address">{{trans('label.address')}}</label>
            <textarea class="form-control" name="address"
                      id="address">{{$user->address}}</textarea>
        </div>
        <div class="form-group col-lg-12">
            <label for="avatar">{{trans('label.avatar')}}</label>
            <input type="file" class="form-control ckeditor" name="avatar"
                   id="avatar">
        </div>
        <div class="form-group col-lg-6">
            <input type="checkbox" name="is_active" {{$user->is_active == 1 ? 'checked' : ''}} id="is_active"
                   value="{{$user->is_active}}"> {{trans('label.active')}}
        </div>
        <div class="form-group col-lg-6">
            <input type="radio" name="sex" value="1" {{$user->sex == 1 ? 'checked' : ''}}> Nam
            <input type="radio" name="sex" id="sex" value="0" {{$user->sex == 0 ? 'checked' : ''}}> Nữ
        </div>
{{--        <div class="form-group col-lg-12">--}}
{{--            <select name="role_ids[]" id="role_ids" class="form-control" multiple>--}}
{{--                @foreach($roleCompose as $id => $name)--}}
{{--                    <option @if(in_array($id, $roleIds)) selected @endif value="{{$id}}">{{$name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="col-lg-12">
            <button class="btn btn-primary">{{trans('button.done')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
@endsection

@push('js')
    <script type="text/javascript" src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $("#birthday").datetimepicker({format: 'YYYY-MM-DD'});
    </script>
    <script>
        Menu('#ACLMenu', '#userMenu')
    </script>
@endpush
