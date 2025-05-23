@extends('layouts.appdirectorate')
@section('scripts')
<script src="{{ asset('js/replaceModal.js') }}"></script>

@endsection
@section('style')
<style>
    .unassign-form {
        display: inline;
    }

    .unassign-btn {
        padding: 0;
        margin: 0;
        border: none;
        background: none;
        color: #007bff;
        font-size: 16px;
        text-decoration: underline;
        cursor: pointer;
        transition: color 0.3s, text-decoration 0.3s;
    }

    .unassign-btn:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .unassign-btn:focus {
        outline: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Placements</div>

                @if(session('error'))
                <script>
                    alert("{{ session('error') }}"); // Simple alert for the error message
                </script>
                @endif

                @if(session('success'))
                <script>
                    alert("{{ session('success') }}"); // Success message if operation was successful
                </script>
                @endif

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <!-- ASSIGNED STUDENTS TABLE -->
                        <h4>
                            <span style="float: left;"> Assigned Students </span>
                            <span style="float: right;">
                                <form method="POST" action="{{ route('placements.unassignAll') }}" class="unassign-form" onsubmit="return confirm('Are you sure you want to unassign all students?');">
                                    @csrf
                                    <button type="submit" class="btn btn-link unassign-btn">Unassign all</button>
                                </form>
                            </span>
                        </h4>

                        <table class="table table-bordered">
                            <thead>
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
                                    <td>
                                        <!-- Unassign Form -->
                                        <form method="POST" action="{{ route('placements.unassign', $placement->student_id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Unassign</button>
                                        </form>

                                        <!-- Replace Modal Trigger -->
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#replaceModal{{ $placement->student_id }}"
                                            data-gender="{{ $placement->student->gender }}"
                                            data-disability="{{ $placement->student->disability_status }}">
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
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="block">Block</label>
                                                                <select name="block" id="blockSelect{{ $placement->student_id }}" class="form-control" required>
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- UNASSIGNED STUDENTS TABLE -->
                        <h4>Unassigned Students</h4>
                        <table class="table table-bordered">
                            <thead>
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
                                            <button type="submit" class="btn btn-primary btn-sm">Assign Student</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Auto-assign button -->
                        <form method="POST" action="{{ route('placements.autoAssignStudents') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Auto Assign Students</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@section('scripts')
<script>
    // JavaScript for modal logic, multi-replace, etc.
</script>
@endsection