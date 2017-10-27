@extends('layouts.app')

@section('slug', 'welcome')

@section('title', 'Welcome | Corcel')

@section('content')
<div class="row">
    <form action="/messages/create" method="POST">
        <div class="form-group">
            {{ csrf_field() }}

            <input class="form-control @if ($errors->has('message')) is-invalid @endif" type="text" name="message" placeholder="Qué estás pensando?" />

            @if ($errors->has('message'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
        </div>
    </form>
</div>

<div class="row">
    @forelse ($messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @empty
        <p>
            No hay mensajes destacados
        </p>
    @endforelse

    @if(count($messages))
        <div class="mt-2 mx-auto">
            {{ $messages->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
