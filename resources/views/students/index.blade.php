@extends('layouts.appdirectorate')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Students</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Disability Status</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->second_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->disability_status }}</td>
                                    <td>{{ $student->status }}</td>
                                    <td>
                                        <!-- Assign button for each student -->
                                        <form method="POST" action="{{ route('students.assign', $student->student_id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
