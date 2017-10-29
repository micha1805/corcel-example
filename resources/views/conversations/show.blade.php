@extends('layouts.app')

@section('slug', 'conversation')

@section('title', 'Conversation | Corcel')

@section('content')
<div>
    <h1>
        Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}
    </h1>

    @foreach($conversation->privateMessages as $message)
        <div class="card">
            <div class="card-header">
                {{ $message->user->name }} dijo...
            </div>

            <div class="card-block">
                {{ $message->message }}
            </div>

            <div class="card-footer">
                {{ $message->created_at }}
            </div>
        </div>
    @endforeach
</div>
@endsection
