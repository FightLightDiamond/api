@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('verify-users.index')}}">{{trans('table.verify_users')}}</a>
    </li>
    <li class="active">
        <strong>Show</strong>
    </li>
</ol>
<div>
    <table class="table">
        <tbody>
            <tr><th>{{__('label.email')}}</th>
<td>{!! $verify_user->email !!}</td>
</tr><tr><th>{{__('label.phone')}}</th>
<td>{!! $verify_user->phone !!}</td>
</tr><tr><th>{{__('label.otp_verified')}}</th>
<td>{!! $verify_user->otp_verified !!}</td>
</tr><tr><th>{{__('label.google_authentication')}}</th>
<td>{!! $verify_user->google_authentication !!}</td>
</tr>
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    Menu('#ACLMenu', '#verifyUserMenu')
</script>
@endpush
