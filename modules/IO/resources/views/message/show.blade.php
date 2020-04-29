@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('messages.index')}}">{{trans('table.messages')}}</a>
    </li>
    <li class="active">
        <strong>Show</strong>
    </li>
</ol>
<div>
    <table class="table">
        <tbody>
            <tr><th>{{__('label.author')}}</th>
<td>{!! $message->author !!}</td>
</tr><tr><th>{{__('label.content')}}</th>
<td>{!! $message->content !!}</td>
</tr>
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    Menu('#IOMenu', '#messageMenu')
</script>
@endpush
