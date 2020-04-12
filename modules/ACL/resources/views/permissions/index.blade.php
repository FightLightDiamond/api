@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('permissions.index')}}"> Permission </a>
        </li>
        <li class="active">
            <strong> Table </strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('permissions.index')}}" method="GET">
        <div class="col-sm-3 form-group">
            <select name="role_id" class="form-control selectFilter">
                <option value="">Select role</option>
                @foreach($roleCompose as $role_id => $role_name)
                    <option @if(request()->get('role_id') == $role_id) selected
                            @endif value="{{$role_id}}">{{$role_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 form-group">
            <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        </div>
    </form>
    <div class="form-group">
        <div id="table">
            @include('acl::permissions.table')
        </div>
    </div>
    @include('acl::layouts.modals.roleCompose')
@endsection
@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script src="{{asset('build/authorization.js')}}"></script>
    <script>
        Menu('#ACLMenu', '#permissionlTesttMenu')
    </script>
@endpush