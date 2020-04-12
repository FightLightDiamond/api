@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="{{route('admin.crazies.index')}}">{{trans('table.crazies')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('admin.crazies.index')}}" method="POST">
        <div class="col-sm-2 form-group">
            <label for="per_page">{{__('label.per_page')}}</label>
            <select name="per_page" class="form-control selectFilter" id="per_page">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="col-sm-5 form-group">
            <label for="name">{{__('label.search')}}</label>
            <input name="name" class="form-control inputFilter" id="name">
        </div>
        <div class="col-sm-2 form-group">
            <label for="crazy_course_id">{{__('label.crazy_course_id')}}</label>
            <select name="crazy_course_id" class="form-control selectFilter" id="crazy_course_id">
                <option value="">All</option>
                @foreach($crazyCourseCompose as $crazyCourseId => $crazyCourseName)
                    <option value="{{$crazyCourseId}}">{{$crazyCourseName}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2 form-group">
            <label for="is_active">{{__('label.is_active')}}</label>
            <select name="is_active" class="form-control selectFilter" id="is_active">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-sm-1 form-group">
            <label>{{__('label.action')}}</label>
            <a class="btn btn-primary btn-block" href="{{route('admin.crazies.create')}}"><i class="fa fa-plus"></i></a>
        </div>
    </form>
    <div class="form-group" id="table">
        @include('en::admin.crazy.table')
    </div>
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#englishMenu', '#crazyMenu')
    </script>
@endpush