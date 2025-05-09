@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Emergency Contact Information</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('emergency.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Father Name:</label>
                                <input type="text" name="father_name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Grand Father:</label>
                                <input type="text" name="grand_father" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Great Grand Father:</label>
                                <input type="text" name="grand_grand_father" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Name:</label>
                                <input type="text" name="mother_name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Region:</label>
                                <input type="text" name="region" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Woreda:</label>
                                <input type="text" name="woreda" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kebele:</label>
                                <input type="text" name="kebele" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
