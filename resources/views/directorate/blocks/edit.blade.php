@extends('layouts.appdirectorate')

@section('content')
    <style>
        .edit-block-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .edit-block-container h1 {
            margin-bottom: 30px;
            color: #343a40;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container mt-5">
        <div class="edit-block-container">
            <h1 class="text-center">Edit Block</h1>

            <form action="{{ route('directorate.blocks.update', $block->block_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="block_id" class="form-label">Block ID</label>
                    <input type="text" class="form-control" id="block_id" name="block_id" value="{{ $block->block_id }}" required maxlength="10">
                </div>

                <div class="mb-3">
                    <label for="disable_group" class="form-label">Disable Group</label>
                    <select class="form-control" id="disable_group" name="disable_group" required>
                        <option value="Yes" {{ $block->disable_group == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $block->disable_group == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Free" {{ $block->status == 'Free' ? 'selected' : '' }}>Free</option>
                        <option value="Out of" {{ $block->status == 'Out Of' ? 'selected' : '' }}>Out Of Service</option>
                        <option value="Occupied" {{ $block->status == "Occupied" ? 'selected' : '' }}>Occupied</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <select class="form-control" id="capacity" name="capacity" required>
                        <option value="24" {{ $block->capacity == 24 ? 'selected' : '' }}>24</option>
                        <option value="29" {{ $block->capacity == 29 ? 'selected' : '' }}>29</option>
                        <option value="79" {{ $block->capacity == 79 ? 'selected' : '' }}>79</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="reserved_for" class="form-label">Reserved For</label>
                    <select class="form-control" id="reserved_for" name="reserved_for" required>
                        <option value="Male" {{ $block->reserved_for == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $block->reserved_for == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Block</button>
                </div>
            </form>
        </div>
    </div>
@endsection
