@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Emergency Information</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Student Name: 
                        <span class="text-primary">{{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</span>
                    </h5>
                    <p><strong>Student ID:</strong> {{ $student->student_id }}</p>

                    @if($student->emergency)
                        <hr>
                        <h5 class="mt-4">Emergency Contact Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>Father Name:</strong><br>{{ $student->emergency->father_name }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Grand Father:</strong><br>{{ $student->emergency->grand_father }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Great Grand Father:</strong><br>{{ $student->emergency->grand_grand_father }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Mother Name:</strong><br>{{ $student->emergency->mother_name }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Phone:</strong><br>{{ $student->emergency->phone }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Region:</strong><br>{{ $student->emergency->region }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Woreda:</strong><br>{{ $student->emergency->woreda }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Kebele:</strong><br>{{ $student->emergency->kebele }}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mt-4">No emergency information found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
