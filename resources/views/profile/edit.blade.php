<<<<<<< HEAD

@extends($layout)

@section('content')
<div class="container mt-4">
    <h1>Edit Profile</h1>

    <!-- Display Success Message -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Profile Edit Form -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- User (Login) Information -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" 
                   value="{{ old('username', optional($user)->username) }}" required>
            @error('username')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Employee Information -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" 
                   value="{{ old('first_name', optional($employee)->first_name) }}" required>
            @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="second_name">Second Name</label>
            <input type="text" class="form-control" id="second_name" name="second_name" 
                   value="{{ old('second_name', optional($employee)->second_name) }}" required>
            @error('second_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" 
                   value="{{ old('last_name', optional($employee)->last_name) }}" required>
            @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="{{ old('email', optional($employee)->email) }}" required>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" 
                   value="{{ old('phone', optional($employee)->phone) }}" required>
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" 
                   value="{{ old('address', optional($employee)->address) }}" required>
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="citizenship">Citizenship</label>
            <input type="text" class="form-control" id="citizenship" name="citizenship" 
                   value="{{ old('citizenship', optional($employee)->citizenship) }}" required>
            @error('citizenship')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Field (Optional) -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
    </form>
</div>
=======
@extends('layouts.appdirectorate')

@section('content')
    <div class="container mt-4">
        <h1>Edit Profile</h1>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Profile Edit Form -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User (Login) Information -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user ? $user->username : '') }}" required>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Employee Information -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="second_name">Second Name</label>
                <input type="text" class="form-control" id="second_name" name="second_name" value="{{ old('second_name', $employee->second_name) }}" required>
                @error('second_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employee->address) }}" required>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="citizenship">Citizenship</label>
                <input type="text" class="form-control" id="citizenship" name="citizenship" value="{{ old('citizenship', $employee->citizenship) }}" required>
                @error('citizenship')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field (Optional) -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
        </form>
    </div>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
@endsection
