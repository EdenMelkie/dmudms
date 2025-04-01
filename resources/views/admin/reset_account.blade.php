@extends('layouts.appadd')

@section('content')
<div class="container">
    <h2 class="mb-4">Employee List</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered">
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
            @if(isset($employees) && $employees->count() > 0)
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
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9">No employees found.</td>
            </tr>
            @endif

        </tbody>
    </table>

</div>
@endsection