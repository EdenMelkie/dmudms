@extends('layouts.appproc')

@section('styles')
<style>
    .form-group label {
        font-weight: bold;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
        width: 400px;
        margin-left: auto;  /* Align card to the center */
        margin-right: auto; /* Align card to the center */
    }

    .card-body {
        padding: 1.5rem; /* Reduced padding inside the card */
    }

    .form-control {
        padding: 0.5rem; /* Smaller padding for form inputs */
        border-radius: 5px;
        border: 1px solid #ced4da;
        font-size: 0.9rem; /* Smaller font size */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 0.5rem 1rem; /* Smaller padding for the button */
        font-size: 0.9rem; /* Smaller font size */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-group {
        margin-bottom: 1rem; /* Reduced margin for form groups */
    }

    .container {
        max-width: 400px; /* Much smaller width for the container */
        padding: 0 1rem;
    }

    h2 {
        font-size: 1.5rem; /* Smaller heading size */
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
            max-width: 90%; /* Ensure mobile responsiveness */
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Edit Material</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('materials.update', $material->registration_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="block">Block</label>
                    <select name="block" class="form-control" required>
                        @foreach($blocks as $block)
                            <option value="{{ $block }}" {{ $block == $material->block ? 'selected' : '' }}>{{ $block }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="room">Room</label>
                    <select name="room" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room }}" {{ $room == $material->room ? 'selected' : '' }}>{{ $room }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="unlocker">Unlocker</label>
                    <select name="unlocker" class="form-control" required>
                        <option value="Original" {{ $material->unlocker == 'Original' ? 'selected' : '' }}>Original</option>
                        <option value="Copy" {{ $material->unlocker == 'Copy' ? 'selected' : '' }}>Copy</option>
                    </select>
                </div>

                @foreach(['locker', 'chair', 'pure_foam', 'damaged_foam', 'tiras', 'tables', 'chibud'] as $item)
                <div class="form-group">
                    <label for="{{ $item }}">{{ ucwords(str_replace('_', ' ', $item)) }}</label>
                    <input type="number" name="{{ $item }}" class="form-control" value="{{ $material->$item }}" min="0" max="6" required>
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">Update Material</button>
            </form>
        </div>
    </div>
</div>
@endsection
