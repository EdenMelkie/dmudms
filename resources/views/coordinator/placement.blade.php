@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Assignments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Assignment ID</th>
                <th>Proctor Name</th>
                <th>Block</th>
                <th>Assigned Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
            <tr>
                <td>{{ $assignment->placement_id }}</td>
                <td>{{ $assignment->proctor_id }}</td>
                <td>{{ $assignment->block }}</td>
                <td>{{ $assignment->first_entry }}</td>
                <td>
                    <a href="{{ route('reassign.form', $assignment->placement_id) }}" class="btn btn-warning btn-sm">
                        Reassign
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection