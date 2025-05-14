@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <!-- Optionally, add a header image -->
                <!-- <div class="card-header text-center">
                    <img src="{{ asset('images/home.jpg') }}" alt="Home" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                </div> -->

                <div class="card-body text-center p-5">
                    <h1 class="text-primary mb-3">Welcome to the Home Page</h1>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <p class="text-muted fs-5">
                        {{ __('You are logged out! If you want to login, click the Login button above.') }}
                    </p>

                    <div class="d-flex justify-content-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                       
                    </div>

                    <div class="mt-4">
                        <p class="text-muted fs-6">
                            <small>Need assistance? <a href="#" class="text-decoration-none">Contact Support</a></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
