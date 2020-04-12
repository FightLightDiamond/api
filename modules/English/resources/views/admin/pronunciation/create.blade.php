@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.pronunciations.index')}}">{{trans('table.pronunciations')}}</a>
        </li>
        <li class="active">
            <strong>{{__('action.create')}}</strong>
        </li>
    </ol>
    <div class="row">
        <form action="{{route('admin.pronunciations.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Reply</th>
                        <th>Pronunciation</th>
                        <th>Answer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(REPLIES as $k => $name)
                        <tr>
                            <td><input class="form-control englishInput" name="{{$name}}" required></td>
                            <td><input class="form-control englishInput" name="pronunciation_{{$name}}" required></td>
                            <td class="text-center"><input type="radio" name="answer" value="{{$k}}" required></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group col-lg-12">
                <label for="reason">{{__('label.reason')}}</label>
                <textarea class="form-control englishInput" name="reason" id="reason"></textarea>
            </div>
            <div class="form-group col-lg-6 form-group">
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
    <script>
        Menu('#englishMenu', '#pronunciationMenu');
    </script>
@endpush