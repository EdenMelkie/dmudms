@extends('layouts.appcoordinator')

@section('content')
<<<<<<< HEAD
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Full Height) -->
        <div class="col-md-3 bg-light min-vh-100 d-flex flex-column p-3">
            <h4 class="text-center">Coordinator Tasks</h4>
            <hr>
            <div class="list-group">
                <a href="{{ route('coordinator.placement') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line"></i> View Assignment
                </a>
                <a href="{{ route('coordinator.proctor') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-check-circle"></i> Manage Proctors
                </a>
                <a href="{{ route('coordinator.blocks') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-check-circle"></i> View Blocks
                </a>
                <a href="{{ route('coordinator.proctor.assign') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-file-alt"></i> Assign Proctors
                </a>
            </div>
        </div>


        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card min-vh-100 d-flex flex-column justify-content-center align-items-center">
=======
<div class="container">

    <div class="col-md-8">

        <div class="row justify-content-center">

            <form class="card">



>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
                <div class="card-body text-center">
                    <h1 class="mt-3">This is Coordinator's Home Page.</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="text-muted">
<<<<<<< HEAD
                        {{ __('You are logged in as a Coordinator! Do your task freely and securely.') }}
                    </p>
                </div>
            </div>
=======
                        {{ __('You are logged out! If you want to login, click the Login button above.') }}
                    </p>
                </div>
            </form>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
        </div>
    </div>
</div>
@endsection