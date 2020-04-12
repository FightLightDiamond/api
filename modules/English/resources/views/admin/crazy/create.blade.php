@extends('layouts.app')

@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.crazies.index')}}">Crazy</a>
        </li>
        <li class="active">
            <strong>{{__('action.create')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.crazies.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group col-lg-12">
                <label for="name">{{trans('label.name')}}</label>
                <input required class="form-control englishInput" name="name" id="name">
            </div>

            <div class=" col-lg-12">
                <label for="audio">{{trans('label.audio')}}</label>
                <input type="file" required class="form-control" name="audio" id="audio">
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <th width="30px">#</th>
                        <th width="80px">Time</th>
                        <th>Sentence</th>
                        <th>Meaning</th>
                        <th width="50px" class="text-right">
                            <button id="addCreateCrazyBtn" type="button" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </thead>
                    <tbody id="sortable">

                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 form-group">
                <lable>Course</lable>
                <select name="{{'crazy_course_id'}}" class="form-control">
                    @foreach($crazyCourseCompose as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="img">{{trans('label.img')}}</label>
                <input type="file" required class="form-control" name="img" id="img">
            </div>

            <div class="form-group col-lg-12">
                <label for="description">{{trans('label.description')}}</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked value="1" name="is_active" id="is_active">
                    </label>
                </div>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{asset('build/forceSort.js')}}?v={{rand(0, 9999)}}"></script>
    <script>
        forceSort('#sortable', '.no');
    </script>
    <script>
        Menu('#englishMenu', '#crazyMenu')
    </script>
@endpush
