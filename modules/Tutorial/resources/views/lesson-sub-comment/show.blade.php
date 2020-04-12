@extends('layouts.app')
@section('content')
<ol class="breadcrumb">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('lesson-sub-comment.index')}}">lesson_sub_comments</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<div>
    {!! lesson_comment !!}
{!! content !!}
{!! create_by !!}
{!! is_active !!}

</div>
<a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-backward"></i></a>
@endsection