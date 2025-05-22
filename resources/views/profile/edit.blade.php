@extends($layout)

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Edit Profile</h1>

    <!-- Display Success Message -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Profile Edit Form -->
    <form action="{{ route('profile.update') }}" method="POST" class="shadow p-4 rounded-lg bg-light">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- User (Login) Information -->
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <input readonly type="text" class="form-control border-secondary rounded-3" id="username" name="username" 
                       value="{{ old('username', optional($user)->username) }}" required>
                @error('username')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Employee Information -->
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input readonly type="text" class="form-control border-secondary rounded-3" id="first_name" name="first_name" 
                       value="{{ old('first_name', optional($employee)->first_name) }}" required>
                @error('first_name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="second_name" class="form-label">Second Name</label>
                <input readonly type="text" class="form-control border-secondary rounded-3" id="second_name" name="second_name" 
                       value="{{ old('second_name', optional($employee)->second_name) }}" required>
                @error('second_name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input readonly type="text" class="form-control border-secondary rounded-3" id="last_name" name="last_name" 
                       value="{{ old('last_name', optional($employee)->last_name) }}" required>
                @error('last_name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control border-secondary rounded-3" id="email" name="email" 
                       value="{{ old('email', optional($employee)->email) }}" required>
                @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control border-secondary rounded-3" id="phone" name="phone" 
                       value="{{ old('phone', optional($employee)->phone) }}" required>
                @error('phone')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control border-secondary rounded-3" id="address" name="address" 
                       value="{{ old('address', optional($employee)->address) }}" required>
                @error('address')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="citizenship" class="form-label">Citizenship</label>
                <input readonly type="text" class="form-control border-secondary rounded-3" id="citizenship" name="citizenship" 
                       value="{{ old('citizenship', optional($employee)->citizenship) }}" required>
                @error('citizenship')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Password Field (Optional) -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control border-secondary rounded-3" id="password" name="password">
                @error('password')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control border-secondary rounded-3" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
        </div>
    </form>
</div>
@endsection
