@extends('layouts.appdirectorate')

@section('content')
    <!-- Button to trigger the student assignment -->
    <form action="{{ route('students.auto_assign') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Assign Students Automatically</button>
</form>


    <!-- Optional: Display success/error messages here -->
    @if(session('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
@endsection
