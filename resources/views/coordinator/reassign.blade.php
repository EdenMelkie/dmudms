@extends('layouts.appcoordinator')
@section('styles')
<style>
    .custom-select {
        background-color: white;
        /* White background */
        color: transparent;
        /* Invisible text */
        border: 1px solid #ccc;
        /* Optional border */
        padding: 10px;
        font-size: 14px;
        width: 100%;
    }

    .custom-select option {
        color: black;
        /* Show black text when the option is selected */
    }
</style>
@endsection
@section('content')
<div class="container mt-4">
    <h2>Reassign Proctor</h2>

    <div class="card p-4">
        <form action="{{ route('reassign.update', $placement->placement_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proctor Name:</label>
                <input type="text" class="form-control" value="{{ $placement->employee->name ?? $placement->proctor_id }}" disabled>
            </div>

            <div class="mb-3">
                <label>Current Block:</label>
                <input type="text" class="form-control" value="{{ $placement->block }}" disabled>
            </div>

            <div class="mb-3">
                <label for="block">Select New Block:</label>
                <select class="form-select" name="block" class="custom-select" required>
                    <option value="">-- Choose Block --</option>
                    @foreach ($availableBlocks as $block)
                    <option style="background-color: white; color: black" value="{{ $block->block_name }}">{{ $block->block_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Assignment</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection