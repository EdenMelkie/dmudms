@extends('layouts.appadd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h1>
                        Welcome to Admin's Home Page!
                    </h1>
                </div>

                <div class="card-body text-center">
                    <h3 class="mt-3 text-primary">As an admin, you can manage accounts like create, update, and reset accounts.</h3>
                    <br><br><br>
                    <h6 class="text-muted">Welcome aboard!</h6>
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <p class="text-muted">
                        {{ __('You are logged in as an Admin! Feel free to manage accounts securely.') }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    .container {
        padding-top: 40px;
    }

    .card {
        background-color: #f8f9fa;
        border: none;
        border-radius: 15px;
    }

    .card-header {
        background-color: #007bff;
        border-radius: 15px 15px 0 0;
    }

    .card-header h1 {
        font-size: 2rem;
        font-weight: bold;
    }

    .card-body {
        font-family: Arial, sans-serif;
        color: #555;
    }

    .card-body h3 {
        color: #007bff;
        font-size: 1.5rem;
    }

    .card-body h6 {
        font-size: 1.2rem;
    }

    .alert {
        border-radius: 5px;
        margin-top: 20px;
        font-size: 1rem;
    }

    .btn-close {
        background: none;
        border: none;
        color: #000;
    }

    .text-muted {
        font-size: 1rem;
        color: #6c757d;
    }
</style>
@endsection
