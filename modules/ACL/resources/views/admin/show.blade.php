@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('admins.index')}}">{{trans('table.admins')}}</a>
    </li>
    <li class="active">
        <strong>Show</strong>
    </li>
</ol>
<div>
    <table class="table">
        <tbody>
            <tr><th>{{__('label.name')}}</th>
<td>{!! $admin->name !!}</td>
</tr><tr><th>{{__('label.email')}}</th>
<td>{!! $admin->email !!}</td>
</tr>
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    Menu('#ACLMenu', '#adminMenu')
</script>
@endpush
