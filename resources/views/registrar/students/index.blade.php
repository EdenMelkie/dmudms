@extends('layouts.appregistrar')

@section('content')
<<<<<<< HEAD
<div class="container-fluid"> <!-- Changed from container to container-fluid -->
    <h2>Student List</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive"> <!-- Makes table scrollable on small screens -->
        <table class="table table-bordered w-100"> <!-- Added w-100 for full width -->

            <thead class="table-dark">
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Batch</th>
                    <th>Disability Status</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->second_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->batch }}</td>
                    <td>{{ $student->disability_status }}</td>
                    <td>{{ $student->status }}</td>
                    <td>
                        <a href="{{ route('registrar.students.edit', ['id' => $student->student_id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('registrar.students.delete', ['id' => $student->student_id]) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this student?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add Student Button -->
    <div class="d-flex justify-content-between mb-3">
        <li style="list-style: none;">
            <a href="{{ route('students.register') }}" class="btn btn-primary">Create Student</a>

        </li>
        <li style="list-style: none;">
            <a href="{{ route('students.upload.form') }}" class="btn btn-outline-secondary">
                Upload Students
            </a>
        </li>
    </div>

    @endsection
=======
<div class="container">
    <h2>Student List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Room Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->department }}</td>
                <td>{{ $student->room_number }}</td>
                <td>
                    <a href="{{ route('registrar.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('students.delete', $student->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
