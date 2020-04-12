@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admin.fill-in-the-blanks.index')}}">{{trans('table.fill_in_the_blanks')}}</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! $fill_in_the_blanks ->question !!}
{!! $fill_in_the_blanks ->a !!}
{!! $fill_in_the_blanks ->b !!}
{!! $fill_in_the_blanks ->c !!}
{!! $fill_in_the_blanks ->d !!}
{!! $fill_in_the_blanks ->answer !!}
{!! $fill_in_the_blanks ->is_active !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection