@extends('layouts.app')

@section('slug', 'userFacebook')

@section('title', 'Facebook | Corcel')

@section('content')
<form action="/auth/facebook/register" method="POST">
    {{ csrf_field() }}

    <div class="card">
        <div class="card-block">
            <img class="img-thumbnail" src="{{ $facebookUserData->avatar }}" />
        </div>

        <div class="card-block">
            <div class="form-group">
                <label class="form-control-label" for="name">
                    Nombre
                </label>

                <input class="form-control" type="text" name="name" value="{{ $facebookUserData->name }}" readonly />
            </div>
        </div>

        <div class="card-block">
            <div class="form-group">
                <label class="form-control-label" for="email">
                    Email
                </label>

                <input class="form-control" type="text" name="email" value="{{ $facebookUserData->email }}" readonly />
            </div>
        </div>

        <div class="card-block">
            <div class="form-group">
                <label class="form-control-label" for="username">
                    Nombre de usuario
                </label>

                <input class="form-control" type="text" name="username" value="{{ old('username') }}" />
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Registrarse
            </button>
        </div>
    </div>
</form>
@endsection
