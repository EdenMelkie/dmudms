<!-- resources/views/proctor/viewRooms.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>View Rooms</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Room Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $room['name'] }}</td>
                <td>{{ $room['status'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection