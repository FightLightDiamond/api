@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('tutorial.index')}}">{{__('table.tutorials')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('tutorial.index')}}" method="POST">
        <input type="hidden" id="sortFrom" name="sort">
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
        <div class="col-sm-7 form-group">
            <label for="">{{__('label.search')}}</label>
            <input name="name" class="form-control inputFilter">
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
            <a class="btn btn-primary btn-block" href="{{route('tutorial.create')}}"><i class="fa fa-plus"></i></a>
        </div>
    </form>
    <div class="form-group" id="table">
        @include('tut::tutorial.table')
    </div>
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#tutorialMenu')
    </script>
@endpush
