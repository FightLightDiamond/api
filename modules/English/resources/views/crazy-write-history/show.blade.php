@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('crazy-write-histories.index')}}">{{trans('table.crazy_write_histories')}}</a>
    </li>
    <li class="active">
        <strong>Show</strong>
    </li>
</ol>
<div>
    <table class="table">
        <tbody>
            <tr><th>{{__('label.crazy_id')}}</th>
<td>{!! $crazy_write_history->crazy_id !!}</td>
</tr><tr><th>{{__('label.score')}}</th>
<td>{!! $crazy_write_history->score !!}</td>
</tr><tr><th>{{__('label.type')}}</th>
<td>{!! $crazy_write_history->type !!}</td>
</tr>
        </tbody>
    </table>
</div>

@endsection