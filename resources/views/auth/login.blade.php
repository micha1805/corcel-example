@extends('layouts.app')

@section('slug', 'login')

@section('title', 'Login | Corcel')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2 mt-4">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email" class="col-md-4 form-control-label">
                    E-Mail Address
                </label>

                <div class="col-md-6">
                    <input id="email" class="form-control @if ($errors->has('email')) is-invalid @endif" type="email" name="email" value="{{ old('email') }}" autofocus />

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 form-control-label">
                    Password
                </label>

                <div class="col-md-6">
                    <input id="password" class="form-control @if ($errors->has('password')) is-invalid @endif" type="password" name="password" />

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <a class="btn btn-primary" href="/auth/facebook">
        Login con Facebook
    </a>
</div>
@endsection
