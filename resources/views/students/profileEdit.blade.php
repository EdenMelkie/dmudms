@extends('layouts.appstd')

@section('content')
    <div class="container">
        <h1>Edit Student Information</h1>

        <form action="{{ route('students.update', $student->student_id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Password</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
            </div>

            <!-- Add other fields as necessary -->

            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
@endsection
