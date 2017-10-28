@extends('layouts.app')

@section('slug', 'showUser')

@section('title', 'User | Corcel')

@section('content')
<h1 class="h3">
    {{ $user->name }}
</h1>

<div class="row">
    @foreach($user->messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @endforeach
</div>
@endsection
