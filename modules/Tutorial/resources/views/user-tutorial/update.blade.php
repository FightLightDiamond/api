@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('user-tutorials.index')}}">{{trans('table.tutorials')}}</a>
            </li>
            <li class="active">
                <strong>Table</strong>
            </li>
        </ol>
        <form action="{{route('user-tutorials.update', $user_tutorial->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-12">
                <label for="name">{{trans('label.name')}}</label>
                <input  class="form-control" name="name" id="name" value="{{$user_tutorial->name}}">
            </div>
            <div class="form-group col-lg-12">
                <label for="description">{{trans('label.description')}}</label>
                <textarea class="form-control" name="description" id="" cols="30"
                          rows="10">{!! $user_tutorial->description !!}</textarea>
            </div>
            <div class="col-lg-12 form-group">
                <label for="">{{__('label.no')}}</label>
                <div class="form-group">
                    <button id="addSection" type="button" class="btn btn-primary"><i
                                class="glyphicon glyphicon-plus"></i></button>
                </div>
                <ul class="list-group" id="sortable">
                    @foreach($sections as $id => $name)
                        <div class="input-group form-group">
                            <span class="input-group-addon no"></span>
                            <input type="hidden" name="section_ids[]" value="{{$id}}">
                            <input  name="section_names[]" class="form-control" value="{{$name}}">
                            <a href="{{route('section.edit', $id)}}" class="input-group-addon btn btn-default"><i
                                        class="glyphicon glyphicon-edit"></i></a>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class="fileinput fileinput-new form-group col-lg-6 " data-provides="fileinput">
                <div class="fileinput-new thumbnail" data-trigger="fileinput">
                    <img class="img-responsive"
                         src="{{$user_tutorial->img ? asset('storage') .$user_tutorial->img : 'http://placehold.it/200x150'}}"
                         alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail img-responsive"></div>
                <div>
                    <span class="btn btn-white btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="img" id="img" accept="image/*">
                    </span>
                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
                {{--<input type="file" name="img" id="img">--}}
            </div>
            <div class="form-group col-lg-12">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" {{$user_tutorial->is_active !== 1 ?: 'checked'}} name="is_active"
                               id="is_active" value="1">
                    </label>
                </div>
            </div>
            <div class="col-lg-12 form-group">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default isBack">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@push('head')

@endpush
@push('js')
    <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('build/forceSort.js')}}"></script>
    <script src="{{asset('build/test.js')}}"></script>
    <script>
        forceSort(sortable, '.no');
    </script>
    <script>
        Menu('#eLearnMenu', '#userTutorialMenu')
    </script>
@endpush
