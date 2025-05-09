@extends('layouts.appproc')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Placed Students</h2>

    @if($placements->isEmpty())
        <div class="alert alert-info text-center">No students are currently placed in your blocks.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Block</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($placements as $placement)
                        <tr>
                            <td>{{ $placement->student->student_id }}</td>
                            <td>{{ $placement->student->first_name }}</td>
                            <td>{{ $placement->block }}</td>
                            <td>{{ $placement->room }}</td>
                            <td>
                                <span class="badge bg-{{ $placement->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($placement->status) }}
                                </span>
                            </td>
                            <td>{{ $placement->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
