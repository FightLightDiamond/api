@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('lesson-test.index')}}">{{trans('table.lesson_tests')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('lesson-test.index')}}" method="POST">
        <div class="col-sm-2 form-group">
            <label for="">{{trans('label.per_page')}}</label>
            <select name="'per_page'" class="form-control inputFilter">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="col-sm-3 form-group">
            <label for="">{{trans('label.search')}}</label>
            <input name="question" class="form-control inputFilter" placeholder="question...">
        </div>

        <div class="form-group col-sm-2">
            @include('tut::layouts.components.tutorial')
        </div>
        <div class="form-group col-sm-2">
            @include('tut::layouts.components.section')
        </div>
        <div class="form-group col-sm-2">
            @include('tut::layouts.components.lesson')
        </div>

        <!--<div class="col-sm-3 form-group">-->
        <!--<input name="display_name" class="form-control inputFilter" placeholder="display_name">-->
        <!--</div>-->
        <div class="col-sm-2 form-group">
            @include('tut::layouts.components.is_active')
        </div>
        <div class="col-sm-1 form-group">
            <label for="">{{trans('label.action')}}</label>
            <a class="btn btn-primary btn-block" href="{{route('lesson-test.create')}}"><i class="fa fa-plus"></i></a>
            <!--<a class="btn btn-danger"><i class="fa fa-trash"></i></a>-->
        </div>
    </form>
    <div class="form-group" id="table">
        @include('tut::lesson-test.table')
    </div>
    <input type="hidden" value="{{route('section.list')}}" id="sectionListRoute">
    <input type="hidden" value="{{route('lesson.list')}}" id="lessonListRoute">
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script src="{{asset('build/forceSelect.js?v=0')}}"></script>
    <script src="{{asset('build/tutorial.js?v=0')}}"></script>
    <script>
        Menu('#eLearnMenu', '#lessonTestMenu')
    </script>
@endpush
