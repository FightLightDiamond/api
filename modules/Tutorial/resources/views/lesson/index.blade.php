@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('lesson.index')}}">lessons</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('lesson.index')}}" method="POST">
        <div class="col-sm-2 form-group">
            <label for="">{{__('label.per_page')}}</label>
            <select name="'per_page'" class="form-control selectFilter">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="form-group col-lg-3">
            @include('tut::layouts.components.title')
        </div>
        <div class="form-group col-lg-2">
            @include('tut::layouts.components.tutorial')
        </div>
        <div class="form-group col-lg-2">
            @include('tut::layouts.components.section')
        </div>
        <div class="col-sm-2 form-group">
            <label for="">{{__('label.is_active')}}</label>
            <select name="is_active" class="form-control selectFilter">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-sm-1 form-group">
            <label for="">{{__('label.action')}}</label>
            <a class="btn btn-primary btn-block" href="{{route('lesson.create')}}"><i class="fa fa-plus"></i></a>
        </div>
    </form>
    <div class="form-group" id="table">
        @include('tut::lesson.table')
    </div>
    <input type="hidden" value="{{route('section.list')}}" id="sectionListRoute">
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script src="{{asset('build/forceSelect.js?v=0')}}"></script>
    <script src="{{asset('build/tutorial.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#lessonMenu')
    </script>
@endpush
