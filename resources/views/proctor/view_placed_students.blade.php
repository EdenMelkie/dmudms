@extends('layouts.appproc')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Placed Students in My Block</h2>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('proctor.viewPlacedStudents') }}" class="d-flex flex-wrap gap-2 mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search by ID or Name" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
        @if(request('search'))
        <a href="{{ route('proctor.viewPlacedStudents') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>


    @if($placements->isEmpty())
    <div class="alert alert-info text-center shadow-sm">No students are currently placed in your block.</div>
    @else
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Block / Room</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($placements as $placement)
                <tr>
                    <td>{{ $placement->student->student_id }}</td>
                    <td>
                        {{ $placement->student->first_name }}
                        {{ $placement->student->second_name }}
                        {{ $placement->student->last_name }}
                    </td>
                    <td>{{ $placement->block }} / {{ $placement->room }}</td>
                    <td>
                        <a href="{{ route('proctor.viewEmergency', $placement->student->student_id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> View Emergency
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection