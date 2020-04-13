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
            <strong>{{__('action.update')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.crazies.update', $crazy->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-12">
                <label for="name">{{trans('label.name')}}</label>
                <input required class="form-control englishInput" name="name" id="name" value="{{$crazy['name']}}">
            </div>

            <div class="form-group col-lg-12">
                <label for="audio">{{trans('label.audio')}}</label>
                <input type="file" class="form-control" name="audio" id="audio">
            </div>

            <div class="form-group col-lg-12">
                <audio controls preload loop>
                    <source src="{{$crazy->getAudioPath()}}" type="audio/mpeg">
                </audio>
            </div>
            <div class="col-lg-12 form-group">
                <table class="table">
                    <thead>
                    <th width="30px">#</th>
                    <th width="80px">Time</th>
                    <th>Sentence</th>
                    <th>Meaning</th>
                    <th width="50px" class="text-right">
                        <button id="addCrazyBtn" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </th>
                    </thead>
                    <tbody id="sortable">
                        @foreach($details as $detail)
                            <tr>
                                <td >
                                    <span class="btn btn-default no">{{$detail['no']}}</span>
                                </td>
                                <td>
                                    <input type="number" required class="form-control" name="times[{{$detail['id']}}]" value="{{$detail['time']}}">
                                </td>
                                <td>
                                    <input required class="form-control englishInput" name="sentences[{{$detail['id']}}]" value="{{$detail['sentence']}}">
                                </td>
                                <td>
                                    <input required class="form-control" name="meanings[{{$detail['id']}}]" value="{{$detail['meaning']}}">
                                </td>
                                <td class="text-right"><span class="btn btn-danger"><i class="fa fa-remove"></i></span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 form-group">
                <lable>Course</lable>
                <select name="{{'crazy_course_id'}}" class="form-control">
                    @foreach($crazyCourseCompose as $id => $name)
                        <option {{$id == $crazy['crazy_course_id'] ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-12">
                <label for="img">{{trans('label.img')}}</label>
                <input type="file" class="form-control" name="img" id="img">
                <img src="{{ $crazy->getThumbPath('img', [200, 200])}}" alt="{{$crazy->name}}">
            </div>

            <div class="form-group col-lg-12">
                <label for="description">{{trans('label.description')}}</label>
                <textarea class="form-control" name="description"
                          id="description">{{$crazy->description}}</textarea>
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
