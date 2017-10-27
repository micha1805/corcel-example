@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name" class="col-md-4 form-control-label">
                        Name
                    </label>

                    <div class="col-md-6">
                        <input id="name" class="form-control @if ($errors->has('name')) is-invalid @endif" type="text" name="name" value="{{ old('name') }}" autofocus />

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-md-4 form-control-label">
                        Username
                    </label>

                    <div class="col-md-6">
                        <input id="username" class="form-control @if ($errors->has('username')) is-invalid @endif" type="text" name="username" value="{{ old('username') }}" />

                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-4 form-control-label">
                        E-Mail Address
                    </label>

                    <div class="col-md-6">
                        <input id="email" class="form-control @if ($errors->has('email')) is-invalid @endif" type="email" name="email" value="{{ old('email') }}" />

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-4 form-control-label">Password</label>

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
                    <label for="password-confirm" class="col-md-4 form-control-label">
                        Confirm Password
                    </label>

                    <div class="col-md-6">
                        <input id="password-confirm" class="form-control" type="password" name="password_confirmation" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
