@extends('layouts.appadd')

@section('title', 'Manage Students')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h4 class="mb-3 mb-md-0"><i class="fas fa-user-graduate"></i> Manage Students</h4>
            <form method="GET" action="{{ route('admin.students') }}" class="d-flex w-100 w-md-auto student-search-form">
                <input
                    type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search by ID or name..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-light">Search</button>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="table-primary text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Batch</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->batch }}</td>
                        <td>
                            @if($student->status === 'unactivated')
                            <span class="badge bg-success">Unactivated</span>
                            @else
                            <span class="badge bg-secondary">Activated ({{ $student->status }})</span>
                            @endif
                        </td>
                        <td>
                            @if($student->status === 'unactivated')
                            <form method="POST" action="{{ route('admin.students.activate', $student->student_id) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success" type="submit">Activate</button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.students.deactivate', $student->student_id) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-warning" type="submit">Deactivate</button>
                            </form>
                            @endif

                            {{-- Reset Password Button --}}
                            <form method="POST" action="{{ route('admin.students.resetPassword', $student->student_id) }}" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reset this student\'s password?')">
                                    Reset
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No students found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->where('status', 'unactivated')->count())
        <form method="POST" action="{{ route('admin.students.activateAll') }}">
            @csrf
            <button class="btn btn-primary mt-3">Activate All Unactivated</button>
        </form>
        @endif
    </div>
</div>

@push('styles')
<style>
    .student-search-form {
        max-width: 400px;
    }

    .student-search-form .form-control {
        border-radius: 0.375rem 0 0 0.375rem;
    }

    .student-search-form .btn {
        border-radius: 0 0.375rem 0.375rem 0;
    }

    table.table {
        background-color: #fff;
        border-collapse: collapse;
    }

    table thead th {
        background-color: #0d6efd;
        color: white;
        font-weight: bold;
        text-align: center;
    }

    table tbody td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-sm {
        margin: 2px;
        min-width: 80px;
        transition: all 0.2s ease-in-out;
    }

    .btn-sm:hover {
        transform: scale(1.05);
    }

    .badge {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .bg-success {
        background-color: #198754 !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    @media (max-width: 768px) {
        .student-search-form {
            width: 100%;
        }
    }
</style>
@endpush
@endsection