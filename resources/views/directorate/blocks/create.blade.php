@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Register New Block</h1>

        <form action="{{ route('directorate.blocks.store') }}" method="POST">
            @csrf
           
            <!-- Disable Group select box -->
            <div class="form-group">
                <label for="disable_group">Disable Group</label>
                <select class="form-control" id="disable_group" name="disable_group" required>
                    <option value="No">Normal</option>
                    <option value="Yes">Disabled</option>
                </select>
            </div>

            <!-- Status select box -->
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
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
