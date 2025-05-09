@extends('layouts.appproc')

@section('styles')
<style>
    /* Custom styles to improve the appearance */
    .form-group label {
        font-weight: bold;
    }

    .card {
        border-radius: 10px;
        /* Rounded corners for the card */
        width: 500px; /* Set fixed width for the form container */
        margin: 0 auto; /* Center the card horizontally */
    }

    .card-body {
        padding: 2rem;
        /* More space inside the card */
    }

    select.form-control {
        padding: 0.75rem;
        /* Increase padding for better readability */
    }

    .btn {
        font-size: 1.1rem;
        /* Slightly larger button text */
        padding: 0.75rem;
        /* Add padding to the button */
    }

    .btn-primary {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    @media (max-width: 768px) {
        .card {
            width: 100%; /* Ensure the form is responsive */
        }

        .btn {
            font-size: 1rem;
            padding: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Register Materials</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('materials.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="block-select">Block</label>
                            <select name="block" id="block-select" class="form-control" required>
                                <option value="">-- Select Block --</option>
                                @foreach($blocks as $block)
                                <option value="{{ $block }}">{{ $block }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="room-select">Room Number</label>
                            <select name="room" id="room-select" class="form-control" required>
                                <option value="">-- Select Room --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="unlocker">Unlocker</label>
                    <select name="unlocker" id="unlocker" class="form-control" required>
                        <option value="">-- Select Unlocker Type --</option>
                        <option value="Original">Original</option>
                        <option value="Copy">Copy</option>
                    </select>
                </div>

                @foreach(['locker', 'chair', 'pure_foam', 'damaged_foam', 'tiras', 'tables', 'chibud'] as $item)
                <div class="form-group mb-3">
                    <label for="{{ $item }}">{{ ucwords(str_replace('_', ' ', $item)) }}</label>
                    <input type="number" name="{{ $item }}" id="{{ $item }}" class="form-control" required>
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Register Materials</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/material-form.js') }}"></script>
@endpush

@endsection
