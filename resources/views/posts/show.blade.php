@extends('layouts.master')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p><strong>Status:</strong> {{ $post->status }}</p>
    <p><strong>Source:</strong> {{ $post->source ?: 'Manual' }}</p>
    <p><strong>External ID:</strong> {{ $post->external_id ?: 'N/A' }}</p>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
