@extends('layouts.app')

@section('slug', 'userProfile')

@section('title', 'User | Corcel')

@section('content')
<h1 class="h3">
    {{ $user->name }}
</h1>

<a class="btn btn-link" href="/user/{{ $user->username }}/follows">
    Sigue a <span class="badge badge-light">{{ $user->follows->count() }}</span> usuarios
</a>

<a class="btn btn-link" href="/user/{{ $user->username }}/followers">
    Le siguen <span class="badge badge-light">{{ $user->followers->count() }}</span>
</a>

@guest
@else
    @if (Gate::allows('dms', $user))
        <form action="/user/{{ $user->username }}/dms" method="POST">
            {{ csrf_field() }}

            <input class="form-control" type="text" name="message" />

            <button class="btn btn-success">
                Enviar mensaje directo
            </button>
        </form>
    @endif

    @if(Auth::user()->isFollowing($user))
        <form action="/user/{{ $user->username }}/unfollow" method="POST">
            {{ csrf_field() }}

            @if (session('success'))
                <span class="text-success">
                    {{ session('success') }}
                </span>
            @endif

            <button class="btn btn-danger">
                Dejar de seguir
            </button>
        </form>
    @else
        <form action="/user/{{ $user->username }}/follow" method="POST">
            {{ csrf_field() }}

            @if (session('success'))
                <span class="text-success">
                    {{ session('success') }}
                </span>
            @endif

            <button class="btn btn-primary">
                Seguir
            </button>
        </form>
    @endif
@endguest

<div class="row">
    @foreach($user->messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @endforeach
</div>
@endsection
