@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Manage Proctors</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Proctor ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Assigned Block</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proctors as $proctor)
            <tr>
                <td>{{ $proctor->proctor_id }}</td>
                <td>{{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}</td>
                <td>{{ $proctor->email }}</td>
                <td> {{ $proctor->block }} only {{ $proctor->block_count }} block </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection