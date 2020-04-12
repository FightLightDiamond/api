@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('roles.index')}}"> Role </a>
        </li>
        <li class="active">
            <strong> {{__('action.create')}} </strong>
        </li>
    </ol>
    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-lg-6">
            <label for="name">{{trans('label.name')}}</label>
            <input  class="form-control" name="name" id="name">
        </div>

        <div class="form-group col-lg-6">
            <label for="display_name">{{trans('label.display_name')}}</label>
            <input  class="form-control" name="display_name" id="display_name">
        </div>
        <div class="form-group col-lg-12">
            <label for="description">{{trans('label.description')}}</label>
            <textarea  class="form-control ckeditor" name="description" id="description"></textarea>
        </div>

        <div class="form-group col-lg-12">
            <label for="is_active">{{trans('label.is_active')}}</label>
            <div>
                <div class="make-switch switch-small" data-on-label="<i class='entypo-check'></i>"
                     data-off-label="<i class='entypo-cancel'></i>">
                    <input type="checkbox" name="is_active" value="1" checked/>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button class="btn btn-primary">{{trans('button.done')}}</button>
            <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
        </div>
    </form>
@endsection
@push('js')
    <script>
        Menu('#ACLMenu', '#roleMenu')
    </script>
@endpush