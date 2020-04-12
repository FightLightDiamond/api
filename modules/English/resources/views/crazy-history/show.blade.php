@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admin.crazies.history.index')}}">{{trans('table.crazy_histories')}}</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! ${str_singular(crazy_histories)} ->crazy_id !!}
{!! $crazy_history->crazy_id !!}
{!! ${str_singular(crazy_histories)} ->score !!}
{!! $crazy_history->score !!}
{!! ${str_singular(crazy_histories)} ->type !!}
{!! $crazy_history->type !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection