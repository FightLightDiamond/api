@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('tutorial-result.index')}}">{{__('table.tutorial_results')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('tutorial-result.index')}}" method="POST">
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
        <div class="col-lg-2 form-group">
            <label for="">{{__('label.tutorial_id')}}</label>
            <select name="tutorial_id" class="form-control" id="tutorial_id">\
                <option value="">Select option</option>
                @foreach($tutorialCompose as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        {{--<div class="col-lg-2 form-group">--}}
        {{--<label for="">{{__('label.user_id')}}</label>--}}
        {{--<select name="tutorial_id" class="form-control" id="tutorial_id">\--}}
        {{--<option value="">Select option</option>--}}
        {{--@foreach($tutorialCompose as $id => $name)--}}
        {{--<option value="{{$id}}">{{$name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        <div class="col-sm-2 form-group">
            <label for="">{{__('label.score')}}</label>
            <select name="tutorial_id" class="form-control" id="tutorial_id">\
                <option value="">Select option</option>
                @for($i = 0; $i < 11 ; $i ++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <!--<div class="col-sm-3 form-group">-->
        <!--<input name="display_name" class="form-control selectFilter" placeholder="display_name">-->
        <!--</div>-->
        <!--<div class="col-sm-2 form-group">-->
        <!--<select name="is_active" class="form-control selectFilter">-->
        <!--<option value="">All</option>-->
        <!--<option value="1">Active</option>-->
        <!--<option value="0">Inactive</option>-->
        <!--</select>-->
        <!--</div>-->
        {{--<div class="col-sm-1 form-group">--}}
        {{--<a class="btn btn-primary btn-block" href="{{route('tutorial-result.create')}}"><i class="fa fa-plus"></i></a>--}}
        {{--<!--<a class="btn btn-danger"><i class="fa fa-trash"></i></a>-->--}}
        {{--</div>--}}
    </form>
    <div class="form-group" id="table">
        @include('tut::tutorial-result.table')
    </div>
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#tutorialResultMenu')
    </script>
@endpush
