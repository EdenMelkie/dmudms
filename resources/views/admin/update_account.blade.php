@extends('layouts.appadd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h2>{{ __('Update Account') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('account.update', $employee->employee_id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Employee ID -->
                        <div class="row mb-3">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>
                            <div class="col-md-6">
                                <input id="employee_id" type="text" class="form-control" name="employee_id" value="{{ $employee->employee_id }}" readonly>
                            </div>
                        </div>

                        <!-- First Name -->
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Name -->
                        <div class="row mb-3">
                            <label for="second_name" class="col-md-4 col-form-label text-md-end">{{ __('Second Name') }}</label>
                            <div class="col-md-6">
                                <input id="second_name" type="text" class="form-control @error('second_name') is-invalid @enderror" name="second_name" value="{{ old('second_name', $employee->second_name) }}" required>
                                @error('second_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $employee->address) }}" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Citizenship -->
                        <div class="row mb-3">
                            <label for="citizenship" class="col-md-4 col-form-label text-md-end">{{ __('Citizenship') }}</label>
                            <div class="col-md-6">
                                <input id="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror" name="citizenship" value="{{ old('citizenship', $employee->citizenship) }}" required>
                                @error('citizenship')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">{{ __('Update Account') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    .container {
        padding-top: 40px;
    }

    .card {
        background-color: #f8f9fa;
        border: none;
        border-radius: 15px;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        font-family: Arial, sans-serif;
        color: #555;
    }

    .card-body label {
        font-weight: bold;
    }

    .card-body input {
        border-radius: 5px;
        font-size: 1rem;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
@endsection
