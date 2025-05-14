@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Manage Proctors and Assignments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Proctor ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Blocks</th>
                <th>Assigned Block</th>
                <th>Assigned Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proctors as $proctor)
            <tr>
                <td>{{ $proctor->employee_id }}</td>
                <td>{{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}</td>
                <td>{{ $proctor->email }}</td>
                <td>{{ $proctor->block_count }}</td>
                <td>{{ $proctor->blocks }}</td>
                <td>{{ $proctor->first_entry }}</td>
               <td>
                <a href="{{ route('proctor.edit1',$proctor->employee_id) }}"> Edit </a>
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
