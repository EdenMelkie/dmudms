@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Emergency Information</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('emergency.update', $emergency->emergence_id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control" value="{{ $emergency->father_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Grand Father</label>
                            <input type="text" name="grand_father" class="form-control" value="{{ $emergency->grand_father }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Grand Grand Father</label>
                            <input type="text" name="grand_grand_father" class="form-control" value="{{ $emergency->grand_grand_father }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mother Name</label>
                            <input type="text" name="mother_name" class="form-control" value="{{ $emergency->mother_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $emergency->phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Region</label>
                            <input type="text" name="region" class="form-control" value="{{ $emergency->region }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Woreda</label>
                            <input type="text" name="woreda" class="form-control" value="{{ $emergency->woreda }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kebele</label>
                            <input type="text" name="kebele" class="form-control" value="{{ $emergency->kebele }}" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Update Emergency Info</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
