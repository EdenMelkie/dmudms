@extends('layouts.appadd')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('account.update', $employee->employee_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="employee_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>
                            <div class="col-md-6">
                                <input id="employee_id" type="text" class="form-control" name="employee_id"
                                    value="{{ $employee->employee_id }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name', $employee->first_name) }}" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="second_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Second Name') }}</label>
                            <div class="col-md-6">
                                <input id="second_name" type="text"
                                    class="form-control @error('second_name') is-invalid @enderror" name="second_name"
                                    value="{{ old('second_name', $employee->second_name) }}" required>
                                @error('second_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name', $employee->last_name) }}" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', $employee->address) }}" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="citizenship"
                                class="col-md-4 col-form-label text-md-end">{{ __('Citizenship') }}</label>
                            <div class="col-md-6">
                                <input id="citizenship" type="text"
                                    class="form-control @error('citizenship') is-invalid @enderror" name="citizenship"
                                    value="{{ old('citizenship', $employee->citizenship) }}" required>
                                @error('citizenship')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update Account') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection