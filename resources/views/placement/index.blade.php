@extends('layouts.appdirectorate')

@section('style')
<style>
    .unassign-btn {
        border: none;
        background: none;
        color: #007bff;
        font-size: 14px;
        text-decoration: underline;
        cursor: pointer;
        transition: color 0.3s;
    }

    .unassign-btn:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .form-inline .form-control {
        margin-right: 10px;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    .modal .form-group {
        margin-bottom: 15px;
    }

    .section-title {
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: bold;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('js/replaceModal.js') }}"></script>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Placements</h5>
        </div>

        <div class="card-body">

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search and Actions -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <form method="GET" action="{{ route('placements.index') }}" class="d-flex flex-wrap align-items-center gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search by Student ID or Name" value="{{ request('search') }}" style="min-width: 250px;">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(request('search'))
                    <a href="{{ route('placements.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </form>

                <form method="POST" action="{{ route('placements.unassignAll') }}" onsubmit="return confirm('Are you sure you want to unassign all students?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Unassign All</button>
                </form>
            </div>

            <!-- Assigned Students Table -->
            <h5 class="section-title">Assigned Students</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Batch</th>
                            <th>B / R</th>
                            <th>Sex</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($placements as $placement)
                        <tr data-gender="{{ $placement->student->gender }}" data-disability="{{ $placement->student->disability_status }}">
                            <td>{{ $placement->student->student_id }}</td>
                            <td>{{ $placement->student->first_name }} {{ $placement->student->second_name }} {{ $placement->student->last_name }}</td>
                            <td>{{ $placement->student->batch }}</td>
                            <td>{{ $placement->block }} / {{ $placement->room }}</td>
                            <td>{{ $placement->student->gender }}</td>
                            <td>{{ $placement->student->disability_status }}</td>
                            <td class="d-flex gap-2">
                                <form method="POST" action="{{ route('placements.unassign', $placement->student_id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Unassign</button>
                                </form>

                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#replaceModal{{ $placement->student_id }}">
                                    Replace
                                </button>

                                <!-- Replace Modal -->
                                <div class="modal fade" id="replaceModal{{ $placement->student_id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('placements.replace', $placement->student_id) }}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Replace Student {{ $placement->student_id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="block">Block</label>
                                                        <select name="block" class="form-control" required>
                                                            @foreach($blocks as $block)
                                                            <option value="{{ $block->block_id }}">{{ $block->block_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="room_id">Room</label>
                                                        <select name="room_id" class="form-control" required>
                                                            @foreach($freeRooms as $room)
                                                            @if($room->block === $placement->block)
                                                            <option value="{{ $room->room_id }}">{{ $room->room_id }} ({{ $room->block }})</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Replace</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Unassigned Students -->
            <h5 class="section-title">Unassigned Students</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students->where('status', '!=', 'assigned') as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->status }}</td>
                            <td>
                                <form method="POST" action="{{ route('placements.assignStudentToPlacement', $student->student_id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Auto-Assign -->
            <form method="POST" action="{{ route('placements.autoAssignStudents') }}">
                @csrf
                <button type="submit" class="btn btn-success w-100">Auto Assign Students</button>
            </form>
        </div>
    </div>
</div>
@endsection