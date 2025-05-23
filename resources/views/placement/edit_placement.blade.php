@extends('layouts.appdirectorate')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Edit Placement for Student: {{ $placement->student->student_id }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('placements.updating', $placement->placement_id) }}">
                @csrf
                @method('PUT')

                <!-- Block Selection -->
                <div class="form-group mb-3">
                    <label for="block">Block</label>
                    <select name="block" class="form-control" required>
                        @foreach($blocks as $block)
                        @php
                        $genderMatch = ($block->reserved_for === $placement->student->gender || $block->reserved_for === 'Mixed');
                        $disabilityMatch = ($placement->student->disability_status !== 'Yes' || $block->disable_group === 'Yes');
                        $hasCapacity = $block->assigned_students_count < $block->capacity;
                        @endphp

                        @if($genderMatch && $disabilityMatch && $hasCapacity)
                        <option value="{{ $block->block_id }}" {{ $placement->block == $block->block_id ? 'selected' : '' }}>
                            Block {{ $block->block_id }} - {{ $block->reserved_for }} -
                            Occupied: {{ $block->assigned_students_count }}/{{ $block->capacity }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <!-- Room Selection -->
                <div class="form-group mb-3">
                    <label for="room_id">Room</label>
                    <select name="room_id" class="form-control" required>
                        @foreach($freeRooms as $room)
                        <option value="{{ $room->room_id }}" {{ $placement->room == $room->room_id ? 'selected' : '' }}>
                            Room {{ $room->room_id }} (Block {{ $room->block }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success">Save Changes</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
