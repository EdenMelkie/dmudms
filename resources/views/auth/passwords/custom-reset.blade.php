@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Your Password</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('password.reset.default') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="email">Registered Email:</label>
            <input type="email" name="email" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Reset to Default</button>
    </form>
</div>
@endsection
