@extends('layouts.appdirectorate')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Available Blocks</h2>
    <a href="{{ route('directorate.blocks.create') }}" class="btn btn-primary mb-3">Register New Block</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Block ID</th>
                <th>Disable Group</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Reserved For</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blocks as $block)
            <tr>
                <td>{{ $block->block_id }}</td>
                <td>{{ $block->disable_group }}</td>
                <td>{{ $block->status }}</td>
                <td>{{ $block->capacity }}</td>
                <td>{{ $block->reserved_for }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-5 text-center">Block Reports</h3>
    @foreach ($blocks as $block)
    <div class="card my-3">
        <div class="card-header bg-primary text-white">
            Block ID: {{ $block->block_id }}
        </div>
        <div class="card-body">
            <p><strong>Total Capacity:</strong> {{ $block->capacity }}</p>
            <p><strong>Free Rooms:</strong>
                {{ $block->rooms->where('status', 'free')->count() }}
            </p>
            <p><strong>Assigned Students:</strong>
                {{ $block->assignedStudents->count() }}
            </p>
            <p><strong>Assigned Proctors:</strong></p>
            @if($block->assignedProctors->isEmpty())
            <p class="text-danger">No proctors assigned</p>
            @else
            <ul>
                @foreach ($block->assignedProctors as $proctor)
                <li>{{ $proctor->first_name }} {{ $proctor->last_name }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    @endforeach


</div>
@endsection
