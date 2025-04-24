@extends('layouts.appdirectorate')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Students Without Placement</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Disability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{  $student->second_name  }} {{ $student->last_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->disability_status }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary assign-btn" 
                                    data-student-id="{{ $student->student_id }}">
                                Assign Placement
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="assignmentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Assign Student</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Block</label>
                        <select name="block" class="form-control" required>
                            @foreach($blocks as $block)
                                <option value="{{ $block->block_id }}">{{ $block->block_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Room Number</label>
                        <input type="number" name="room" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.assign-btn').click(function() {
        var studentId = $(this).data('student-id');
        var form = $('#assignmentForm');
        form.attr('action', "{{ route('directorate.students.assign', '') }}/" + studentId);
        $('#assignmentModal').modal('show');
    });
});
</script>
@endsection