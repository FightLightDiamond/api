@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('tutorial.index')}}">{{trans('table.tutorials')}}</a>
        </li>
        <li>
            <a href="{{route('section.index')}}">sections</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('section.index')}}" method="POST">
        <div class="col-sm-2 form-group">
            <label for="">{{__('label.per_page')}}</label>
            <select name="'per_page'" class="form-control inputFilter">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="col-sm-5 form-group">
            <label for="">{{__('label.search')}}</label>
            <input name="name" class="form-control inputFilter" placeholder="name">
        </div>
        <!--<div class="col-sm-3 form-group">-->
        <!--<input name="display_name" class="form-control inputFilter" placeholder="display_name">-->
        <!--</div>-->
        <div class="col-sm-2 form-group">
            <label for="">{{__('label.is_active')}}</label>
            <select name="is_active" class="form-control selectFilter">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-sm-2 form-group">
            <label for="">{{__('table.tutorials')}}</label>
            <select class="form-control selectFilter" name="tutorial_id" id="tutorial_id">
                <option value=""></option>
                @foreach($tutorialCompose as $id => $name)
                    <option {{request()->get('tutorial_id') != $id ?: 'selected'}} value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-1 form-group">
            <label for="">{{__('label.action')}}</label>
            <a class="btn btn-primary btn-block" href="{{route('section.create')}}"><i class="fa fa-plus"></i></a>
            <!--<a class="btn btn-danger"><i class="fa fa-trash"></i></a>-->
        </div>
    </form>
    <div class="form-group" id="table">
        @include('tut::section.table')
    </div>
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#sectiontMenu')
    </script>
@endpush
