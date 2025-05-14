@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Edit Emergency Information</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('emergency.update', $emergency->emergence_id) }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ $emergency->father_name }}" required>
                                @error('father_name') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Grand Father</label>
                                <input type="text" name="grand_father" class="form-control @error('grand_father') is-invalid @enderror" value="{{ $emergency->grand_father }}" required>
                                @error('grand_father') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Grand Grand Father</label>
                                <input type="text" name="grand_grand_father" class="form-control @error('grand_grand_father') is-invalid @enderror" value="{{ $emergency->grand_grand_father }}" required>
                                @error('grand_grand_father') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ $emergency->mother_name }}" required>
                                @error('mother_name') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $emergency->phone }}" required>
                                @error('phone') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Region</label>
                                <input type="text" name="region" class="form-control @error('region') is-invalid @enderror" value="{{ $emergency->region }}" required>
                                @error('region') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Woreda</label>
                                <input type="text" name="woreda" class="form-control @error('woreda') is-invalid @enderror" value="{{ $emergency->woreda }}" required>
                                @error('woreda') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kebele</label>
                                <input type="text" name="kebele" class="form-control @error('kebele') is-invalid @enderror" value="{{ $emergency->kebele }}" required>
                                @error('kebele') 
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success px-4">Update Emergency Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
