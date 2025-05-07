@extends('layouts.appdirectorate')
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

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
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
                                    <th>Placement ID</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Block / Room</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($placements as $placement)
                                <tr data-gender="{{ $placement->student->gender }}" data-disability="{{ $placement->student->disability_status }}">
                                    <td>{{ $placement->placement_id }}</td>
                                    <td>{{ $placement->student->student_id }}</td>
                                    <td>{{ $placement->student->first_name }} {{ $placement->student->second_name }} {{ $placement->student->last_name }}</td>
                                    <td>{{ $placement->block }} / {{ $placement->room }}</td>
                                    <td>{{ $placement->status }}</td>
                                    <td>
                                        <!-- Unassign Form -->
                                        <form method="POST" action="{{ route('placements.unassign', $placement->student_id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Unassign</button>
                                        </form>

                                        <!-- Replace Modal Trigger -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#replaceModal{{ $placement->student_id }}">
                                            Replace
                                        </button>

                                        <!-- Replace Modal -->
                                        <div class="modal fade" id="replaceModal{{ $placement->student_id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('placements.replace', $placement->student_id) }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Replace {{ $placement->student->first_name }}'s Room</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Current Room</label>
                                                                <input type="text" class="form-control" value="{{ $placement->block }} / {{ $placement->room }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">New Block</label>
                                                                <select name="block" class="form-select" required>
                                                                    @foreach($blocks as $block)
                                                                    <option value="{{ $block->block_id }}" {{ $block->block_id == $placement->block ? 'selected' : '' }}>
                                                                        Block {{ $block->block_id }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Available Rooms</label>
                                                                <select name="room_id" class="form-select" required>
                                                                    <option value="">Loading available rooms...</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Replace</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id^="replaceModal"]').forEach(modal => {
            const blockSelect = modal.querySelector('select[name="block"]');
            const roomSelect = modal.querySelector('select[name="room_id"]');
            const studentRow = modal.closest('tr');
            const studentGender = studentRow.getAttribute('data-gender') || '';
            const studentDisability = studentRow.getAttribute('data-disability') || '';

            blockSelect.addEventListener('change', function() {
                fetchAvailableRooms(this.value, studentGender, studentDisability, roomSelect);
            });

            // Initialize on modal open
            modal.addEventListener('show.bs.modal', function() {
                fetchAvailableRooms(blockSelect.value, studentGender, studentDisability, roomSelect);
            });
        });

        function fetchAvailableRooms(blockId, gender, disability, roomSelect) {
            fetch(`/api/available-rooms?block=${blockId}&gender=${gender}&disability=${disability}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(rooms => {
                    roomSelect.innerHTML = '';

                    if (!rooms || rooms.length === 0) {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No available rooms matching criteria';
                        roomSelect.appendChild(option);
                        return;
                    }

                    rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.room_id;
                        option.textContent = `Room ID: ${room.room_id} (${room.status}) - ${room.available_beds}/${room.capacity} beds available`;
                        roomSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    roomSelect.innerHTML = '';
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Error loading rooms';
                    roomSelect.appendChild(option);
                });
        }
    });
</script>
@endsection