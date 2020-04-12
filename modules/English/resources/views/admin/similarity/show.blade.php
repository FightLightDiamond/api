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
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! ${str_singular(similarities)} ->question !!}
{!! ${str_singular(similarities)} ->replacement !!}
{!! ${str_singular(similarities)} ->a !!}
{!! ${str_singular(similarities)} ->b !!}
{!! ${str_singular(similarities)} ->c !!}
{!! ${str_singular(similarities)} ->d !!}
{!! ${str_singular(similarities)} ->answer !!}
{!! ${str_singular(similarities)} ->reason !!}
{!! ${str_singular(similarities)} ->is_active !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection