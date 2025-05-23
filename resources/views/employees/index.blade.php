@extends('layouts.appadd')
@section('styles')
<style>
    main{
        margin-bottom: 40px;
    }
</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Employee List</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('employees.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name, email..." value="{{ request()->query('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <a href="{{ route('admin.create_account') }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Add Employee
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Citizenship</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->second_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->citizenship }}</td>
                        <td class="text-center">
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info me-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this employee?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if ($employees->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-muted">No employees found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
