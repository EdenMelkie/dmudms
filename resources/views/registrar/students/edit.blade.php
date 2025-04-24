@extends('layouts.appregistrar')

@section('content')
<div class="container">
    <h2>Edit Student</h2>

<<<<<<< HEAD
    
    <form action="{{ route('registrar.students.update', $student->student_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Ensure the request is recognized as an update -->

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $student->first_name }}" required>
        </div>

        <div class="mb-3">
            <label for="second_name" class="form-label">Second Name</label>
            <input type="text" class="form-control" id="second_name" name="second_name" value="{{ $student->second_name }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>

        <div class="mb-3">
            <label for="batch" class="form-label">Batch</label>
            <input type="batch" class="form-control" id="batch" name="batch" value="{{ $student->batch }}" required>
=======
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $student->full_name }}" required>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
<<<<<<< HEAD
            <label for="disability_status" class="form-label">Disability Status</label>
            <select class="form-control" id="disability_status" name="disability_status">
                <option value="No" {{ $student->disability_status == 'None' ? 'selected' : '' }}>None</option>
                <option value="Yes" {{ $student->disability_status == 'Disabled' ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="Registered" {{ $student->status == 'Active' ? 'selected' : '' }}>Registered</option>
                <option value="Desciplined" {{ $student->status == 'Inactive' ? 'selected' : '' }}>Desciplined</option>
                <option value="Desciplined" {{ $student->status == 'Inactive' ? 'selected' : '' }}>Transferred</option>
                <!-- <option value="Desciplined" {{ $student->status == 'Inactive' ? 'selected' : '' }}>Desciplined</option> -->
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('registrar.students') }}" class="btn btn-secondary">Back</a>
=======
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ $student->department }}" required>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label">Room Number</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="{{ $student->room_number }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
    </form>
</div>
@endsection
