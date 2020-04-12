@extends('acl::auth.layout')
@section('content')
    <div class="login-form">
        <div class="login-content">
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <input type="hidden" class="form-control" name="recaptcha" id="recaptcha">

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user-add"></i>
                        </div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                               autofocus>
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
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="fa fa-sign-in"></i>
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
      grecaptcha.ready(function() {
        grecaptcha.execute('6LcKDq8UAAAAAJHAYLGPotaNuG6BaGdmIaBwfP3N', {action: 'register'}).then(function(token) {
          if(token) {
            document.getElementById('recaptcha').value = token;
          }
        });
      });
    </script>
@endpush