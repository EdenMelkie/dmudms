@extends('layouts.appproc')

@section('content')
<div class="container">

    <div class="col-md-8">

        <div class="row justify-content-center">

            <form class="card">



                <div class="card-body text-center">
                    <h1 class="mt-3">This is Proctor's Home Page.</h1>

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