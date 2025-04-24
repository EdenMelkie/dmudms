@extends('layouts.appdirectorate')

@section('content')
<<<<<<< HEAD
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
=======
    <div class="container mt-4">
        <h1 class="text-center">Manage Students</h1>
        
        @if ($students->isEmpty())
            <div class="alert alert-warning text-center mt-4">
                <strong>No students found!</strong> Please add students to manage.
            </div>
        @else
            <!-- Student Table -->
            <table class="table table-bordered mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Second Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->second_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span class="badge 
                                    @if($student->status == 'Assigned') 
                                        bg-success
                                    @elseif($student->status == 'Not Assigned')
                                        bg-warning text-dark
                                    @endif
                                ">
                                    {{ $student->assigned ? 'Assigned' : 'Not Assigned' }}
                                </span>
                            </td>
                            <td>
                                @if(!$student->assigned)
                                    <!-- Action for unassigned students -->
                                    <a href="{{ route('students.assign', $student->student_id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check-circle"></i> Assign
                                    </a>
                                @else
                                    <!-- Action for assigned students -->
                                    <a href="{{ route('students.reassign', $student->student_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-redo-alt"></i> Reassign
                                    </a>
                                @endif
                                <button class="btn btn-danger btn-sm" onclick="deleteStudent('{{ $student->student_id }}')">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function deleteStudent(studentId) {
            if (confirm('Are you sure you want to delete this student?')) {
                // Make an AJAX call to delete the student
                window.location.href = '/students/delete/' + studentId;
            }
        }
    </script>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
@endsection
