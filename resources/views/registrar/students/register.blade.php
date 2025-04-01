@extends('layouts.appregistrar')

@section('content')
<div class="container mt-4">
        <h2>Register Students</h2>

        <!-- Manual Registration Form -->
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="second_name" class="form-label">Second Name</label>
                <input type="text" class="form-control" id="second_name" name="second_name">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" required>
            </div>
            <div class="mb-3">
                <label for="disability_status" class="form-label">Disability Status</label>
                <input type="text" class="form-control" id="disability_status" name="disability_status" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <button type="submit" class="btn btn-primary">Register Student</button>
        </form>

        <hr>

        <!-- File Upload Form -->
        <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Upload Students (Excel/CSV)</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-success">Upload File</button>
        </form>
    </div>
    @endsection

