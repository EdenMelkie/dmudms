@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Edit Block</h1>

        <form action="{{ route('directorate.blocks.update', $block->block_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="block_id">Block ID</label>
                <input type="text" class="form-control" id="block_id" name="block_id" value="{{ $block->block_id }}" required maxlength="10">
            </div>

            <!-- Disable Group select box -->
            <div class="form-group">
                <label for="disable_group">Disable Group</label>
                <select class="form-control" id="disable_group" name="disable_group" required>
                    <option value="Yes" {{ $block->disable_group == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ $block->disable_group == 'No' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <!-- Status select box -->
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Free" {{ $block->status == 'Free' ? 'selected' : '' }}>Free</option>
                    <option value="OutOf" {{ $block->status == 'OutOf' ? 'selected' : '' }}>OutOf</option>
                    <option value="Can't" {{ $block->status == "Can't" ? 'selected' : '' }}>Can't</option>
                </select>
            </div>

            <!-- Capacity select box -->
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <select class="form-control" id="capacity" name="capacity" required>
                    <option value="24" {{ $block->capacity == 24 ? 'selected' : '' }}>24</option>
                    <option value="29" {{ $block->capacity == 29 ? 'selected' : '' }}>29</option>
                    <option value="79" {{ $block->capacity == 79 ? 'selected' : '' }}>79</option>
                </select>
            </div>

            <!-- Reserved For select box -->
            <div class="form-group">
                <label for="reserved_for">Reserved For</label>
                <select class="form-control" id="reserved_for" name="reserved_for" required>
                    <option value="Male" {{ $block->reserved_for == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $block->reserved_for == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Block</button>
        </form>
    </div>
@endsection
