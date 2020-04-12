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
            <strong>{{__('action.create')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.crazy-courses.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group col-lg-12">
                <label for="name">{{trans('label.name')}}</label>
                <input required class="form-control" name="name" id="name">
            </div>
            <div class="form-group col-lg-12">
                <label>Lesson</label>
                <table class="table">
                    <tr>
                        <thead>
                        <th>
                            <input type="checkbox" class="checkAll" name="crazy_ids[]">
                        </th>
                        <th>Name</th>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
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
                        <input type="checkbox" required checked value="1" name="is_active" id="is_active">
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
    <script>
        Menu('#englishMenu', '#crazyCourseMenu')
    </script>
@endpush
