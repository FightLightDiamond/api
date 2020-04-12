@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.similarities.index')}}">{{trans('table.similarities')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.update')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.similarities.update', $similarity->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-12">
                <label for="question">{{trans('label.question')}}</label>
                <input class="form-control englishInput" name="question" id="question" value="{{$similarity->question}}">
            </div>
            @foreach(REPLIES as $k => $value)
                <div class="form-group col-lg-6">
                    <label for="a">{{trans('label.' . $value)}}</label>
                    <div class="input-group">
                        <input class="form-control englishInput" value="{{$similarity->$value}}" name="{{$value}}" id="{{$value}}" required>
                        <span class="input-group-addon">
                            <input type="radio" value="{{$k}}" {{$similarity->answer == $k ? 'checked' : ''}} name="answer" required>
                        </span>
                    </div>
                </div>
            @endforeach
            <div class="form-group col-lg-12">
                <label for="replacement">{{trans('label.replacement')}}</label>
                <input required class="form-control englishInput" name="replacement" id="replacement" value="{{$similarity->replacement}}">
            </div>
            <div class="form-group col-lg-12">
                <label for="reason">{{__('label.reason')}}</label>
                <textarea class="form-control englishInput" name="reason" id="reason">{{$similarity->reason}}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="is_active">{{trans('label.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" {{$similarity->is_active == 1 ? 'checked' : ''}} checked value="1" name="is_active" id="is_active">
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
        Menu('#englishMenu', '#similarityMenu');
    </script>
@endpush