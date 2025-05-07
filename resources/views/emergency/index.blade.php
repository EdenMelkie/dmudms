@extends('layouts.appstd')

@section('content')
<div class="container">
    <h2>Emergency Information</h2>

    <div class="card p-3">
        <h4>Student Name: {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</h4>
        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
        
        @if($student->emergency)
            <h5>Emergency Contact</h5>
            <ul>
                <li><strong>Father Name:</strong> {{ $student->emergency->father_name }}</li>
                <li><strong>Grand Father:</strong> {{ $student->emergency->grand_father }}</li>
                <li><strong>Great Grand Father:</strong> {{ $student->emergency->grand_grand_father }}</li>
                <li><strong>Mother Name:</strong> {{ $student->emergency->mother_name }}</li>
                <li><strong>Phone:</strong> {{ $student->emergency->phone }}</li>
                <li><strong>Region:</strong> {{ $student->emergency->region }}</li>
                <li><strong>Woreda:</strong> {{ $student->emergency->woreda }}</li>
                <li><strong>Kebele:</strong> {{ $student->emergency->kebele }}</li>
            </ul>
        @else
            <p>No emergency information found.</p>
        @endif
    </div>
</div>
@endsection
