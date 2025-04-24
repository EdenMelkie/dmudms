@extends('layouts.appregistrar')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="w-50"> <!-- Reduced width to 50% -->
        <h2 class="text-center">Create Student</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" class="p-4 border rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="second_name" class="form-label">Second Name</label>
                <input type="text" id="second_name" name="second_name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="batch" class="form-label">Batch</label>
                <input type="number" id="batch" name="batch" required class="form-control">
            </div>


            <div class="mb-3">
                <label for="disability_status" class="form-label">Disability Status</label>
                <select name="disability_status" id="disability_status" class="form-control">
                    <option value="Yes">Normal</option>
                    <option value="No">Disabled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Student</button>
        </form>
    </div>
</div>
@endsection