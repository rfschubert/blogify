@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="display-4 mb-4">
            Hello, {{ auth()->check() ? auth()->user()->name : 'Guest' }}!
        </h1>

        <section class="latest-posts">
            <h2 class="h4 mb-4">Last published posts</h2>
            <div class="row" style="gap: 10px;">
                @foreach($posts ?? [] as $post)
                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
