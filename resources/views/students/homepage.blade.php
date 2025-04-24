<<<<<<< HEAD
<!-- resources/views/students/homepage.blade.php -->
@extends('layouts.appstd') 

@section('content')
    <h1>Welcome to the Student Homepage</h1>
@endsection
=======
@extends('layouts.appstd')

@section('content')
<div class="container">

    <div class="col-md-8">

        <div class="row justify-content-center">

            <form class="card">



                <div class="card-body text-center">
                    <h1 class="mt-3">This is Student's Home Page.</h1>

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
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
