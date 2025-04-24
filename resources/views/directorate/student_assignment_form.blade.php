@extends('layouts.appdirectorate')

@section('content')
    <h1>Assign Student to Room</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Assign student form -->
    <form action="{{ route('student.assign') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Select Student:</label>
            <select name="student_id" id="student_id" required class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->student_id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div><br>

        <div class="form-group">
            <label for="block_id">Select Block:</label>
            <select name="block_id" id="block_id" required class="form-control">
                @foreach($blocks as $block)
                    <option value="{{ $block->block_id }}">{{ $block->block_id }}</option>
                @endforeach
            </select>
        </div><br>

        <div class="form-group">
            <label for="room_id">Select Room:</label>
            <select name="room_id" id="room_id" required class="form-control">
                @foreach($blocks as $block)
                    @foreach($block->rooms as $room)
                        <option value="{{ $room->room_id }}">{{ $room->room_id }} ({{ $room->status }})</option>
                    @endforeach
                @endforeach
            </select>
        </div><br>

        <button type="submit" class="btn btn-primary">Assign Student</button>
    </form>

    <!-- Button to trigger auto assign students -->
    <form action="{{ route('students.auto_assign') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-success">Auto Assign Students</button>
    </form>
@endsection
