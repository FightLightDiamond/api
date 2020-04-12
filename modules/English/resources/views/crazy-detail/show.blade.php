@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admin.crazies.detail.index')}}">{{trans('table.crazy_details')}}</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! ${str_singular(crazy_details)} ->crazy_id !!}
{!! $crazy_detail->crazy_id !!}
{!! ${str_singular(crazy_details)} ->no !!}
{!! $crazy_detail->no !!}
{!! ${str_singular(crazy_details)} ->sentence !!}
{!! $crazy_detail->sentence !!}
{!! ${str_singular(crazy_details)} ->meaning !!}
{!! $crazy_detail->meaning !!}
{!! ${str_singular(crazy_details)} ->created_by !!}
{!! $crazy_detail->created_by !!}
{!! ${str_singular(crazy_details)} ->updated_by !!}
{!! $crazy_detail->updated_by !!}
{!! ${str_singular(crazy_details)} ->is_active !!}
{!! $crazy_detail->is_active !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection