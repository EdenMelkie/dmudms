@extends('layouts.appadd')

@section('content')
<div class="container">
    <h2>Employee Details</h2>

    <table class="table">
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

    <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection