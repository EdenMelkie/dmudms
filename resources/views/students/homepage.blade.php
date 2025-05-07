@extends('layouts.appstd') 

@section('content')
    <h1>Welcome to the Student Homepage</h1>

    <p>Username: {{ session('username') }}</p>
    <p>User Type: {{ session('userType') }}</p>
@endsection
