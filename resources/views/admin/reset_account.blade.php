@extends('layouts.appadd')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Employee List</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Citizenship</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->first_name }} {{ $employee->second_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->citizenship }}</td>
                <td>{{ $employee->role }}</td>
                <td>
                    @if($employee->status == 'active')
                    <span class="badge bg-success">{{ ucfirst($employee->status) }}</span>
                    @else
                    <span class="badge bg-danger">{{ ucfirst($employee->status) }}</span>
                    @endif
                </td>
                <td>
                    <!-- View Button -->
                    <a href="{{ route('employees.show', $employee->employee_id) }}" class="btn btn-info btn-sm">View</a>

                    <!-- Update Button -->
                    <a href="{{ route('employees.edit', $employee->employee_id) }}" class="btn btn-warning btn-sm">Update</a>

                    <!-- Delete Button -->
                    <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add custom styling for table -->
<style>
    .container {
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    h2 {
        color: #007bff;
        font-weight: bold;
    }

    .alert {
        margin-top: 20px;
        font-size: 1rem;
        border-radius: 5px;
    }

    .table {
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .thead-dark {
        background-color: #343a40;
        color: white;
    }

    .badge {
        font-size: 0.9rem;
        padding: 5px 10px;
    }

    .btn-sm {
        font-size: 0.9rem;
        padding: 5px 12px;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-close {
        background: none;
        border: none;
        color: #000;
    }
</style>
@endsection
