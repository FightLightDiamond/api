@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.crazies.index')}}">{{trans('table.crazies')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <div>
        {!! $crazy->name !!}
        {!! $crazy->name !!}
        {!! $crazy->audio !!}
        {!! $crazy->audio !!}
        {!! $crazy->created_by !!}
        {!! $crazy->created_by !!}
        {!! $crazy->updated_by !!}
        {!! $crazy->updated_by !!}
        {!! $crazy->is_active !!}
        {!! $crazy->is_active !!}

    </div>
    <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection

@push('js')
    <script>
        Menu('#englishMenu', '#crazyMenu')
    </script>
@endpush