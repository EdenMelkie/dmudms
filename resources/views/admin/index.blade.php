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
                    <a href="{{ route('employees.edit', $employee->employee_id) }}"
                        class="btn btn-warning btn-sm">Update</a>

                    <!-- Delete Button -->
                    <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="POST"
                        style="display:inline;">
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
@endsection