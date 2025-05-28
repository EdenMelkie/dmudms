@extends('layouts.appadd')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white fw-bold rounded-top-4">{{ __('Register') }}</div>

                <div class="card-body px-4 py-3">

                    <form method="POST" action="{{ route('employee.upload.form') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Upload File') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>
                                <button type="submit" class="btn btn-primary px-3"> <i class="fas fa-upload"></i>Upload</button>
                                @error('file')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </form>


                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        @php
                        $fields = [
                        'employee_id' => 'Employee ID',
                        'first_name' => 'First Name',
                        'second_name' => 'Second Name',
                        'last_name' => 'Last Name',
                        'email' => 'Email',
                        'phone' => 'Phone',
                        'address' => 'Address',
                        'citizenship' => 'Citizenship',
                        ];
                        @endphp

                        @foreach ($fields as $name => $label)
                        <div class="mb-3 row">
                            <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">{{ __($label) }}</label>
                            <div class="col-md-6">
                                <input id="{{ $name }}" type="{{ $name === 'email' ? 'email' : 'text' }}"
                                    class="form-control @error($name) is-invalid @enderror"
                                    name="{{ $name }}" value="{{ old($name) }}" required autocomplete="{{ $name }}"
                                    placeholder="{{ $name == 'employee_id' ? 'e.g., Emp0001' : '' }}">

                                @if ($name === 'employee_id')
                                <small class="text-muted">Format: Emp0001, Emp0002, etc.</small>
                                @endif

                                @error($name)
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        @endforeach

                        <div class="mb-3 row">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                                    <option value="">Select Role</option>
                                    @foreach(['Directorate', 'Registrar', 'Maintenance', 'Admin', 'Proctor', 'Coordinator'] as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
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
@endsection