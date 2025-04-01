@extends('layouts.appadd')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card">
                <div class="card-header text-center">
                    <h1>
                        This is Admin's Home page!
                    </h1>
                </div>


                <div class="card-body text-center">
                    <h3 class="mt-3">so, as admin you can manage accounts like create, update and reset accounts.</h3>
                    <br><br><br>
                    <h6> well come!</h6>
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