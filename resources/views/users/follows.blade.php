@extends('layouts.app')

@section('slug', 'userFollows')

@section('title', 'Follows | Corcel')

@section('content')
<div>
    <h1>
        {{ $user->name }}
    </h1>

    <ul class="list-unstyled">
        @foreach($follows as $follow)
            <li>
                {{ $follow->username }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
