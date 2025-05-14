@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Available Blocks</h2>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Block ID</th>
                <th>Disable Group</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Reserved For</th>
                <th>Proctors</th> {{-- New Column --}}
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
                <td>
                    @if($block->assignedProctors->isEmpty())
                    <span class="text-danger">None</span>
                    @else
                    <ul class="mb-0 ps-3" style="list-style: none; padding-left: 0;">
                        @foreach ($block->assignedProctors as $proctor)
                        <li>{{ $proctor->first_name }} {{ $proctor->last_name }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {{-- Assign Proctor Action --}}
                    <form action="{{ route('proctor.place', $block->block_id) }}" method="GET" class="mt-2">
                        <button type="submit" class="btn btn-sm btn-success">Assign Proctor</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-5 text-center">Block Reports</h3>
    @foreach ($blocks as $block)
    <div class="card my-3 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Block ID:</strong> {{ $block->block_id }}
        </div>
        <div class="card-body">
            <p><strong>Total Capacity:</strong> {{ $block->capacity }}</p>
            <p><strong>Free Rooms:</strong> {{ $block->rooms->where('status', 'free')->count() }}</p>
            <p><strong>Assigned Students:</strong> {{ $block->assignedStudents->count() }}</p>

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

<!-- Add Custom Styles -->
<style>
    .container {
        margin-top: 40px;
    }

    .table {
        margin-bottom: 30px;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:hover {
        background-color: #e2e2e2;
    }

    .card {
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .card-header {
        font-size: 18px;
        font-weight: bold;
        background-color: #007bff;
        color: white;
        padding: 15px;
    }

    .card-body {
        background-color: #f8f9fa;
        padding: 20px;
        font-size: 16px;
    }

    .card-body p {
        margin: 10px 0;
    }

    .text-danger {
        color: red;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white;
    }

    @media (max-width: 768px) {

        .table th,
        .table td {
            font-size: 14px;
            padding: 8px;
        }

        .card-body {
            font-size: 14px;
        }

        .card-header {
            font-size: 16px;
        }
    }
</style>
@endsection