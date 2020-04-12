@extends('en::layouts.app')

@section('content')
    @yield('doing')
    @include('edu::tests.components.status')
@endsection

@section('bot')
  @include('en::test.components.mark')
@endsection

@push('js')
  <script src="{{asset('assets/js/bootstrap-switch.min.js')}}"></script>
  <script src="{{asset('modules/English/js/app.js')}}"></script>

@endpush