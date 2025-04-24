@extends('layouts.appdirectorate')

@section('content')
<div class="container">

    <div class="col-md-8">

        <div class="row justify-content-center">

            <form class="card">



                <div class="card-body text-center">
                    <h1 class="mt-3">This is Directorate's Home Page.</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="text-muted">
<<<<<<< HEAD
                        {{ __('You are logged in as a S.S Directorate! Do your task freely and securely.') }}
=======
                        {{ __('You are logged out! If you want to login, click the Login button above.') }}
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection