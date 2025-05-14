@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-info text-white rounded-top-4">
                    <h4 class="mb-0">Emergency Information</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Student Name: 
                        <span class="text-primary fw-bold">{{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</span>
                    </h5>
                    <p><strong>Student ID:</strong> <span class="fw-bold">{{ $student->student_id }}</span></p>

                    @if($student->emergency)
                        <hr class="my-4">
                        <h5 class="mt-4 text-success">Emergency Contact Details</h5>
                        <div class="row">
                            @php
                                $emergency_fields = [
                                    'Father Name' => $student->emergency->father_name,
                                    'Grand Father' => $student->emergency->grand_father,
                                    'Great Grand Father' => $student->emergency->grand_grand_father,
                                    'Mother Name' => $student->emergency->mother_name,
                                    'Phone' => $student->emergency->phone,
                                    'Region' => $student->emergency->region,
                                    'Woreda' => $student->emergency->woreda,
                                    'Kebele' => $student->emergency->kebele,
                                ];
                            @endphp

                            @foreach ($emergency_fields as $label => $value)
                                <div class="col-md-6 mb-3">
                                    <strong>{{ $label }}:</strong><br>
                                    <span class="fw-semibold">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mt-4 mb-0">No emergency information found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
