@extends('layouts.appadd')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-info text-white rounded-top-4">
            <h4 class="mb-0">Employee Details</h4>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $employee->employee_id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->first_name }} {{ $employee->second_name }} {{ $employee->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $employee->phone }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $employee->address }}</td>
                </tr>
                <tr>
                    <th>Citizenship</th>
                    <td>{{ $employee->citizenship }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $employee->role }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($employee->status) }}</td>
                </tr>
            </table>

            <div class="d-grid mt-3">
                <a href="{{ route('employees.index') }}" class="btn btn-primary px-4">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
