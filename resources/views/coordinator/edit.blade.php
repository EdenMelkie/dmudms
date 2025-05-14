<!-- resources/views/coordinator/edit.blade.php -->
@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Edit Proctor Assignment</h2>

    <form action="{{ route('proctor.update', $proctor->proctor_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="proctor_id">Proctor</label>
            <input type="text" name="proctor_id" class="form-control" value="{{ $proctor->proctor_id }}" readonly>
        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $proctor->first_name }}" readonly>
        </div>

        <div class="form-group">
            <label for="second_name">Second Name</label>
            <input type="text" name="second_name" class="form-control" value="{{ $proctor->second_name }}" readonly>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $proctor->last_name }}" readonly>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $proctor->gender }}" readonly>
        </div>

        <div class="form-group">
            <label for="block">Assigned Block</label>
            <select name="block" id="block" class="form-control">
                @foreach ($rooms as $room)
                <option value="{{ $room->block_id }}"
                    {{ $proctor->block === $room->block_id ? 'selected' : '' }}>
                    {{ $room->block_id }} ({{ $room->reserved_for }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" value="{{ $proctor->year ?? date('Y') }}">
        </div>


        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection