@extends('layouts.appadd')

@section('title', 'Manage Students')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4><i class="fas fa-user-graduate"></i> Manage Students</h4>
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Batch</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->batch }}</td>
                    <td>
                        @if($student->status === 'unactivated')
                        <span class="badge bg-success">unctivated</span>
                        @else
                        <span class="badge bg-secondary">Activated and {{ $student->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($student->status === 'unactivated')
                        <form method="POST" action="{{ route('admin.students.activate', $student->student_id) }}" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success" type="submit">Activate</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.students.deactivate', $student->student_id) }}" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-warning" type="submit">Deactivate</button>
                        </form>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($students->where('status', 'unactivated')->count())
        <form method="POST" action="{{ route('admin.students.activateAll') }}">
            @csrf
            <button class="btn btn-primary mt-3">Activate All Unactivated</button>
        </form>
        @endif
    </div>
</div>
@endsection