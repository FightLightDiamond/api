@extends('edu::layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li class="active">
            <strong>Thông tin cá nhân</strong>
        </li>
    </ol>
    <div class="row">
        <div class="col-sm-3 col-md-2 form-group">
            @if(trim(auth()->user()->avatar) !== '')
                <div class="form-group">
                    <img class="img-responsive img-circle img-thumbnail"
                         src="{{ asset('storage/' . auth()->user()->avatar )}}">
                </div>
            @endif
            <div class="form-group text-center">
                @for($i=1; $i <=5; $i++)
                    <span data-toggle="modal" data-start="{{$i}}" data-target="#rateUserModal"
                          class="btn btn-xs btn-primary rateUserBtn">
                    <i class="fa fa-star"></i>
                </span>
                @endfor
            </div>
        </div>
        <div class="col-md-10 col-sm-3">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <strong>{{trans('label.first_name')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->first_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.last_name')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->last_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.email')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.phone_number')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->phone_number}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.coin')}}</strong>
                    </td>
                    <td style="color: goldenrod">
                        <strong>{{ number_format(auth()->user()->coin)}} <i class="fa fa-bitcoin"></i></strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.address')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->address}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('label.sex')}}</strong>
                    </td>
                    <td>
                        {{auth()->user()->sex == 1 ? 'Male' : 'Female'}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            2-Step Verification
                            @if(auth()->user()->verifyUser[OTP_VERIFIE'd'])
                                <lable class="text-success">Enable</lable>
                            @else
                                <lable class="text-danger">Disable</lable>
                            @endif
                        </strong>
                    </td>
                    <td>
                        @if(auth()->user()->verifyUser[OTP_VERIFIE'd'])
                            <button class="btn btn-xs btn-danger">Disable</button>
                        @else
                            <button class="btn btn-xs btn-success" id="Enable2stepBtn" data-toggle="modal"
                                    data-target="#twoStep">
                                enable
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>Profile detail</strong></td>
                    <td><a href="{{route('user-profiles.index')}}"><i class="fa fa-link"></i></a></td>
                </tr>
            </table>
            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#profile">
                <i class="fa fa-edit"></i> {{__('button.edit')}}
            </button>
            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#change_password">
                <i class="fa fa-refresh"></i> Thay đổi mật khẩu
            </button>
            <a class="btn btn-default btn-xs" href="{{route('my-cart')}}">
                <i class="fa fa-cart-plus"></i> chi tiết hóa đơn
            </a>
            <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#transaction">
                <i class="fa fa-transgender"></i> Transaction Coin
            </button>
            <a class="btn btn-default btn-xs" href="{{route('user-images.index')}}"><i class="fa fa-image"></i></a>
        </div>
    </div>

    <input type="hidden" id="createOtpRoute" value="{{route('otp.google')}}">
    @include('acl::users.modal.rate-user')
    @include('acl::users.modal.update-profile')
    @include('acl::users.modal.update-pass')
    @include('acl::users.modal.transaction')
    @include('acl::users.modal.2-step-enable')
    @include('acl::users.modal.2-step-disable')
    @include('acl::users.modal.2-step-verification')
@endsection
@push('css')
    <link rel="stylesheet"
          href="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}"/>
@endpush
@push('js')
    <script type="text/javascript" src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script  type="text/javascript" src="{{asset('build/forceForm.js')}}"></script>
    <script type="text/javascript" src="{{asset('modules/ACL/js/app.js')}}?v={{rand(0, 9999)}}"></script>
@endpush
