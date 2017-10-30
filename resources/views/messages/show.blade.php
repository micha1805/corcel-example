@extends('layouts.app')

@section('slug', 'messageShow')

@section('title', 'Message | Corcel')

@section('content')
<div>
    <h1 class="h3">
        ID del mensaje: {{ $message->id }}
    </h1>

    @include('messages.message')

    <responses :message="{{ $message->id }}"></responses>
</div>
@endsection
