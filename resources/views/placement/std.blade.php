@extends('layouts.appdirectorate')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Placement Info for Student: {{ $placement->student->student_id }}</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Placement ID</th>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Block / Room</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-gender="{{ $placement->student->gender }}" data-disability="{{ $placement->student->disability_status }}">
                        <td>{{ $placement->placement_id }}</td>
                        <td>{{ $placement->student->student_id }}</td>
                        <td>{{ $placement->student->first_name }} {{ $placement->student->second_name }} {{ $placement->student->last_name }}</td>
                        <td>{{ $placement->block }} / {{ $placement->room }}</td>
                        <td>{{ $placement->status }}</td>
                        <!-- Edit Button to Open Modal -->
                        <td>
                            <a href="{{ route('placements.edit', $placement->placement_id) }}" class="btn btn-warning">
                                Edit Placement
                            </a>
                        </td>


                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection