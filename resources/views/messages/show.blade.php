@extends('layouts.app')

@section('slug', 'message')

@section('title', 'Message | Corcel')

@section('content')
<div>
    <h1 class="h3">
        ID del mensaje: {{ $message->id }}
    </h1>

    @include('messages.message')
</div>
@endsection
