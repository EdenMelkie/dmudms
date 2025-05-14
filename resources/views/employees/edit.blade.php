@extends('layouts.appadd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-user-edit me-2"></i>Update Employee Account
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.update', $employee->employee_id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Employee ID --}}
                        <div class="mb-3 row">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-end">Employee ID</label>
                            <div class="col-md-6">
                                <input id="employee_id" type="text" class="form-control bg-light" name="employee_id"
                                    value="{{ $employee->employee_id }}" readonly>
                            </div>
                        </div>

                        {{-- First Name --}}
                        <div class="mb-3 row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">First Name</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Second Name --}}
                        <div class="mb-3 row">
                            <label for="second_name" class="col-md-4 col-form-label text-md-end">Second Name</label>
                            <div class="col-md-6">
                                <input id="second_name" type="text" class="form-control @error('second_name') is-invalid @enderror"
                                    name="second_name" value="{{ old('second_name', $employee->second_name) }}" required>
                                @error('second_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Last Name --}}
                        <div class="mb-3 row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">Last Name</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3 row">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="mb-3 row">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ old('address', $employee->address) }}" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Citizenship --}}
                        <div class="mb-4 row">
                            <label for="citizenship" class="col-md-4 col-form-label text-md-end">Citizenship</label>
                            <div class="col-md-6">
                                <input id="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror"
                                    name="citizenship" value="{{ old('citizenship', $employee->citizenship) }}" required>
                                @error('citizenship')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Update Account
                                </button>
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
