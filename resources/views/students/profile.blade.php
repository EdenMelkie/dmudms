@extends('layouts.appstd')

@section('content')
<div class="container">
    <h2>Student Profile</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $student->student_id }}</p>
            <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Gender:</strong> {{ $student->gender }}</p>
            <p><strong>Batch:</strong> {{ $student->batch }}</p>

            @if($student->emergency)
                <h4>Emergency Info</h4>
                <p><strong>Father Name:</strong> {{ $student->emergency->father_name }}</p>
                <p><strong>Mother Name:</strong> {{ $student->emergency->mother_name }}</p>
                <p><strong>Phone:</strong> {{ $student->emergency->phone }}</p>
                <p><strong>Region:</strong> {{ $student->emergency->region }}</p>
                <p><strong>Woreda:</strong> {{ $student->emergency->woreda }}</p>
                <p><strong>Kebele:</strong> {{ $student->emergency->kebele }}</p>
            @endif

            <a href="{{ route('student.profileEdit', $student->student_id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
