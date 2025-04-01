@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card">
                <div class="card-header text-center">
                    <img src="{{ asset('images/home.jpg') }}" alt="Home" class="img-fluid rounded">
                </div>

                <div class="card-body text-center">
                    <h1 class="mt-3">This is our Home Page.</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="text-muted">
                        {{ __('You are logged out! If you want to login, click the Login button above.') }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection