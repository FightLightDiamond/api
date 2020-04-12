@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/home"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a>Vocabulary</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <form class="form-group row" id="formFilter" action="{{route('admin.vocabularies.index')}}" method="POST">
        <div class="col-sm-3 form-group">
            <input  name="word" class="form-control inputFilter" placeholder="word">
        </div>
        <div class="col-sm-2 form-group">
            <input  name="type" class="form-control inputFilter" placeholder="type">
        </div>
        <div class="col-sm-3 form-group">
            <input  name="meaning" class="form-control inputFilter" placeholder="meaning">
        </div>
        <div class="col-sm-2 form-group">
            <select name="is_active" class="form-control selectFilter">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-sm-2 form-group">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a class="btn btn-primary form-group" href="{{route('admin.vocabularies.create')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <input type="file" route="{{route('admin.vocabulary.import')}}"
                           id="importFile" name="file"
                           class="form-group form-control file2 inline btn btn-success"
                           data-label="<i class='fa fa-upload'></i> "/>
                </div>
                <div class="btn-group" role="group">
                    <span class="btn btn-info form-group">
                        <i class="glyphicon glyphicon-export"></i>
                    </span>
                </div>
            </div>
        </div>
    </form>
    <div class="form-group" id="table">
        @include('en::admin.vocabularies.table')
    </div>
@endsection

@push('js')
<script src="{{asset('build/form-filter.js')}}"></script>

<script>
    Menu('#englishMenu', '#vocabularyMenu');
</script>
@endpush