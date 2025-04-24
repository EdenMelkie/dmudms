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
                <th>Assigned Rooms</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proctors as $proctor)
            <tr>
                <td>{{ $proctor->id }}</td>
                <td>{{ $proctor->name }}</td>
                <td>{{ $proctor->email }}</td>
                <td>{{ $proctor->assignedRooms->count() }}</td> <!-- Assuming a relationship exists -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
