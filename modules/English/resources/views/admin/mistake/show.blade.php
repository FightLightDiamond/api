@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admin.mistakes.index')}}">{{trans('table.mistakes')}}</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! $mistakes ->question !!}
{!! $mistakes ->a !!}
{!! $mistakes ->b !!}
{!! $mistakes ->c !!}
{!! $mistakes ->d !!}
{!! $mistakes ->answer !!}
{!! $mistakes ->repair !!}
{!! $mistakes ->is_active !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection