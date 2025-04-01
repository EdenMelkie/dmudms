@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Register New Block</h1>

        <form action="{{ route('directorate.blocks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="block_id">Block ID</label>
                <input type="text" class="form-control" id="block_id" name="block_id" required maxlength="10">
            </div>

            <!-- Disable Group select box -->
            <div class="form-group">
                <label for="disable_group">Disable Group</label>
                <select class="form-control" id="disable_group" name="disable_group" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <!-- Status select box -->
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Free">Free</option>
                    <option value="OutOf">OutOf</option>
                    <option value="Can't">Can't</option>
                </select>
            </div>

            <!-- Capacity select box -->
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <select class="form-control" id="capacity" name="capacity" required>
                    <option value="24">24</option>
                    <option value="29">29</option>
                    <option value="79">79</option>
                </select>
            </div>

            <!-- Reserved For select box -->
            <div class="form-group">
                <label for="reserved_for">Reserved For</label>
                <select class="form-control" id="reserved_for" name="reserved_for" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Register Block</button>
        </form>
    </div>
@endsection
