@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Manage Proctors and Assignments</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Proctor ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th># Blocks</th>
                        <th>Assigned Blocks</th>
                        <th>Assigned Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proctors as $proctor)
                    <tr class="text-center">
                        <td>{{ $proctor->employee_id }}</td>
                        <td>{{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}</td>
                        <td>{{ $proctor->email }}</td>
                        <td>{{ $proctor->block_count }}</td>
                        <td>{{ $proctor->blocks }}</td>
                        <td>{{ $proctor->first_entry }}</td>
                        <td>
                            <a href="{{ route('proctor.edit1', $proctor->employee_id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-pen-to-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection