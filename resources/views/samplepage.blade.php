@extends('layouts.app')

@section('slug', 'samplePage')

@section('title', '{{ $samplePage->title }} | Corcel')

@section('content')
<div>
    <h1>
        {{ $samplePage->title }}
    </h1>

    <p>
        {!! $samplePage->content !!}
    </p>

    <strong>By </strong>{{ $samplePage->author->display_name }}
</div>
@endsection
