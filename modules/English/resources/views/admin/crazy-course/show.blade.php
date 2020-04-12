@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="{{route('admin.crazy-courses.index')}}">{{__('table.crazy_courses')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <div>
        <label for="">Info</label>
        <table class="table">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{$crazyCourse->name}}</td>
            </tr>
            <tr>
                <td>Img</td>
                <td><img src="{{$crazyCourse->getThumbPath('img', [200, 200])}}"
                         alt="{{$crazyCourse->name}}"></td>
            <tr>
                <td>Description</td>
                <td>{!! $crazyCourse->description !!}</td>
            </tr>
            <tr>
                <td>Active</td>
                <td>{{$crazyCourse->is_active}}</td>
            </tr>
            <td>Creator</td>
            <td>{{$crazyCourse->created_by}}</td>
            <tr>
                <td>Updater</td>
                <td>{{$crazyCourse->updated_by}}</td>
            </tr>
            </tbody>
        </table>
        <label for="">Crazies</label>
        <table class="table">
            @foreach($crazyList as $id => $name)
                <tr>
                    <td>{{$name}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
@push('js')
    <script>
        Menu('#englishMenu', '#crazyCourseMenu')
    </script>
@endpush
