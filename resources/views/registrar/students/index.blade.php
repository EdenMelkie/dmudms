@extends('layouts.appregistrar')

@section('content')
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
