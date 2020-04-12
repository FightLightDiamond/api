@extends('acl::auth.layout')
@section('content')
    <div class="login-form">
        <div class="login-content">
            <div class="form-login-error">
                <h3>Invalid login</h3>
                <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
            </div>
            <form role="form" method="POST" action="{{ url('/login') }}" id="form_login">
                {{csrf_field()}}

                <input type="hidden" class="form-control" name="recaptcha" id="recaptcha">

                @if ($errors->has('recaptcha'))
                    <span class="help-block">
                        <strong>{{ $errors->first('recaptcha') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user-add"></i>
                        </div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="fa fa-sign-in"></i>
                        {{__('auth.login')}}
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{asset('register')}}" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-register"></i>
                        {{__('auth.register')}}
                    </a>
                </div>
            </form>
            <div class="login-bottom-links">
                <a href="{{ route('password.request') }}"class="link">{{__('common.forgot_password_message')}}?</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
      grecaptcha.ready(function() {
        grecaptcha.execute('6LcKDq8UAAAAAJHAYLGPotaNuG6BaGdmIaBwfP3N', {action: 'login'}).then(function(token) {
          if(token) {
            document.getElementById('recaptcha').value = token;
          }
        });
      });
    </script>
@endpush