@extends('layouts.appregistrar')

@section('content')
<div class="container-fluid">
    <h2 class="my-4 text-primary"><i class="fas fa-users"></i> Student List</h2>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Student Table --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body table-responsive">
            <div class="card shadow-sm mb-4 rounded-4">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-striped table-sm align-middle w-100 text-center">
                        <thead class="table-dark">
                            <tr class="align-middle">
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Second Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Batch</th>
                                <th>Disability</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->second_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->batch }}</td>
                                <td>{{ $student->disability_status }}</td>
                                <td>
                                    <span class="badge 
                                @if($student->status == 'Registered') bg-success 
                                @elseif($student->status == 'unactivated') bg-secondary 
                                @else bg-warning text-dark 
                                @endif">
                                        {{ $student->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('registrar.students.edit', $student->student_id) }}"
                                        class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('registrar.students.delete', $student->student_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-muted">No students found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Action Buttons --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('students.register') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Create Student
                </a>
                <a href="{{ route('students.upload.form') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-upload"></i> Upload Students
                </a>
            </div>
        </div>
        @endsection