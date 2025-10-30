@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>
            Users
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->name }} ({{ $user->email }})</li>
                @endforeach
            </ul>
        </h1>
    </div>
@endsection
