@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.crazy-courses.index')}}">{{__('table.crazy_courses')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.update')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.crazy-courses.update', $crazyCourse->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-12">
                <label for="name">{{trans('label.name')}}</label>
                <input required class="form-control" name="name" value="{{$crazyCourse->name}}" id="name">
            </div>
            <div class="form-group col-lg-12">
                <label>Lesson</label>
                <table class="table">
                    <tr>
                        <thead>
                        <th></th>
                        <th>Name</th>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
                        @foreach($crazyList as $id => $name)
                            <tr>
                                <td>
                                    <input type="checkbox" checked value="{{$id}}" name="crazy_ids[]">
                                </td>
                                <td>{{$name}}</td>
                            </tr>
                        @endforeach
                        @foreach($crazyNoCourseCompose as $id => $name)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{$id}}" name="crazy_ids[]">
                                </td>
                                <td>{{$name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </tr>
                </table>
            </div>
            <div class="form-group col-lg-12">
                <label for="img">{{trans('label.img')}}</label>
                <input type="file" class="form-control" name="img" id="img">
                <img src="{{ $crazyCourse->getThumbPath('img', [200, 200])}}" alt="{{$crazyCourse->name}}">
            </div>

            <div class="form-group col-lg-12">
                <label for="description">{{trans('label.description')}}</label>
                <textarea class="form-control" name="description"
                          id="description">{{$crazyCourse->description}}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" {{$crazyCourse->is_active == 1 ? 'checked' : ''}} value="1"
                               name="is_active" id="is_active">
                    </label>
                </div>
            </div>

            <div class="col-lg-12 form-group">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        Menu('#englishMenu', '#crazyCourseMenu')
    </script>
@endpush
