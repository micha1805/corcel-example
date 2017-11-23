@extends('layouts.app')

@section('slug', 'messageIndex')

@section('title', 'Search | Corcel')

@section('content')
@foreach ($messages as $message)
    @include('messages.message')
@endforeach
@endsection
