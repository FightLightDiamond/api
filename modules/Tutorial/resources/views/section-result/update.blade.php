@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('section-result.index')}}">_name_</a>
            </li>
            <li class="active">
                <strong>Table</strong>
            </li>
        </ol>
        <form action="{{route('section-result.update', $sectionResult->id)}}" method="POST"
              enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group col-lg-6">
                <label for="created_by">{{trans('label.created_by')}}</label>
                <input type="number" class="form-control" name="created_by" id="created_by"
                       value="{{$sectionResult->created_by}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="section_id">{{trans('label.section_id')}}</label>
                <input type="number" class="form-control" name="section_id" id="section_id"
                       value="{{$sectionResult->section_id}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="score">{{trans('label.score')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="score" id="score" value="{{$sectionResult->score}}">
                    </label>
                </div>
            </div>

            <div class="col-lg-12 form-group">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        Menu('#eLearnMenu', '#sectionResultMenu')
    </script>
@endpush