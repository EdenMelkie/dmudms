@extends('layouts.appadd')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="employee_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>

                            <div class="col-md-6">
                                <input id="employee_id" type="text"
                                    class="form-control @error('employee_id') is-invalid @enderror" name="employee_id"
                                    value="{{ old('employee_id') }}" required autocomplete="employee_id" autofocus>

                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="second_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Second Name') }}</label>

                            <div class="col-md-6">
                                <input id="second_name" type="text"
                                    class="form-control @error('second_name') is-invalid @enderror" name="second_name"
                                    value="{{ old('second_name') }}" required autocomplete="second_name">

                                @error('second_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                    <option value="{{ old('gender') }}" required autocomplete="gender">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="citizenship"
                                class="col-md-4 col-form-label text-md-end">{{ __('Citizenship') }}</label>

                            <div class="col-md-6">
                                <input id="citizenship" type="text"
                                    class="form-control @error('citizenship') is-invalid @enderror" name="citizenship"
                                    value="{{ old('citizenship') }}" required autocomplete="citizenship">

                                @error('citizenship')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role"
                                    required>
                                    <option value="">Select Role</option>
                                    <option value="Directorate" {{ old('role') == 'Directorate' ? 'selected' : '' }}>
                                        Directorate</option>
                                    <option value="Registrar" {{ old('role') == 'Registrar' ? 'selected' : '' }}>
                                        Registrar</option>
                                    <option value="Maintenance" {{ old('role') == 'Maintenance' ? 'selected' : '' }}>
                                        Maintenance</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Proctor" {{ old('role') == 'Proctor' ? 'selected' : '' }}>Proctor
                                    </option>
                                    <option value="Coordinator" {{ old('role') == 'Coordinator' ? 'selected' : '' }}>
                                        Coordinator</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Custom Styles -->
<style>
    .container {
        margin-top: 50px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        padding: 15px 0;
    }

    .card-body {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }

    .row {
        margin-bottom: 15px;
    }

    .col-md-4 {
        text-align: right;
        padding-top: 10px;
    }

    .col-md-6 input,
    .col-md-6 select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-top: 5px;
    }

    .col-md-6 input:focus,
    .col-md-6 select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .invalid-feedback {
        font-size: 12px;
        color: red;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    button[type="submit"]:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Responsive Design for Smaller Screens */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
        }

        .col-md-4,
        .col-md-6 {
            text-align: left;
        }

        .col-md-6 input,
        .col-md-6 select {
            font-size: 14px;
        }

        button[type="submit"] {
            font-size: 14px;
            padding: 12px;
        }
    }
</style> @endsection