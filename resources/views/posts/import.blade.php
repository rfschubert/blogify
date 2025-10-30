@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Import Post</h1>
    <form action="{{ route('posts.import') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="provider">Provider</label>
            <select name="provider" class="form-control" required>
                @foreach($providers as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id">ID</label>
            <input type="number" name="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
