@extends('layouts.appdirectorate')

@section('content')
    <h1>Assign Proctor to Block</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Proctor Assignment Form -->
    <form action="{{ route('directorate.assign_proctor') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="proctor_id">Select Proctor:</label>
            <select name="proctor_id" id="proctor_id" class="form-control" required>
                @foreach($proctors as $proctor)
                    <option value="{{ $proctor->employee_id }}">
                        {{ $proctor->first_name }} {{ $proctor->last_name }} ({{ $proctor->gender }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="block_id">Select Block:</label>
            <select name="block_id" id="block_id" class="form-control" required>
                @foreach($blocks as $block)
                    <option value="{{ $block->block_id }}">
                        {{ $block->block_id }} (Reserved for: {{ $block->reserved_for }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" name="year" id="year" class="form-control" required>
             <!-- Display validation error for year if present -->
             @if($errors->has('year'))
                <div class="text-danger">
                    <strong>{{ $errors->first('year') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="first_entry">First Entry Date:</label>
            <input type="date" name="first_entry" id="first_entry" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Assign Proctor</button>
    </form>
@endsection
