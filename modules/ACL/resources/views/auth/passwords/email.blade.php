@extends('acl::auth.layout')

@section('content')
    <div class="container">
        <div class="form-group text-center">
            <h2 style="color: white">Forgot password</h2>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class=control-label">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
