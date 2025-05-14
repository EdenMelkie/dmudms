@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Register New Block</h1>

        <form action="{{ route('directorate.blocks.store') }}" method="POST">
            @csrf

            <!-- Disable Group select box -->
            <div class="form-group mb-3">
                <label for="disable_group">Disable Group</label>
                <select class="form-control" id="disable_group" name="disable_group" required>
                    <option value="No">Normal</option>
                    <option value="Yes">Disabled</option>
                </select>
            </div>

            <!-- Status select box -->
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Free">Available</option>
                    <option value="Out of">Out of Service</option>
                </select>
            </div>

            <!-- Capacity select box -->
            <div class="form-group mb-3">
                <label for="capacity">Capacity</label>
                <select class="form-control" id="capacity" name="capacity" required>
                    <option value="24">24</option>
                    <option value="29">29</option>
                    <option value="79">79</option>
                </select>
            </div>

            <!-- Reserved For select box -->
            <div class="form-group mb-3">
                <label for="reserved_for">Reserved For</label>
                <select class="form-control" id="reserved_for" name="reserved_for" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Register Block</button>
        </form>
    </div>

    <!-- Add Custom Styles -->
    <style>
        .container {
            max-width: 800px;
            margin-top: 40px;
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            color: #555;
        }

        .form-control {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }

            .form-group label {
                font-size: 16px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px;
            }

            .btn-primary {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
@endsection
