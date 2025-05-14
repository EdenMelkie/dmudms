@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Manage Proctor Placements</h2>

    @if (count($proctorPlacements) > 0)
    @php
        $proctor = $proctorPlacements[0]->proctor;
    @endphp

    {{-- Common Proctor Information --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <strong>Proctor Information</strong>
        </div>
        <div class="card-body">
            <p><strong>First Name:</strong> {{ $proctor->first_name }}</p>
            <p><strong>Second Name:</strong> {{ $proctor->second_name }}</p>
            <p><strong>Last Name:</strong> {{ $proctor->last_name }}</p>
            <p><strong>Email:</strong> {{ $proctor->email }}</p>
        </div>
    </div>

    {{-- Placement Entries --}}
    @foreach ($proctorPlacements as $placement)
    <div class="card mb-4 border-secondary">
        <div class="card-header">
            <strong>Placement {{ $loop->iteration }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('proctor.update1', $placement->placement_id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="proctor_id" value="{{ $placement->proctor_id }}">

                <div class="col-md-6">
                    <label class="form-label fw-bold text-success">Block</label>
                    <select name="block" class="form-select border border-success">
                        @foreach ($roomsByGender[$placement->proctor->gender] as $room)
                            <option value="{{ $room->block_id }}" {{ $room->block_id == $placement->block ? 'selected' : '' }}>
                                {{ $room->block_id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Year</label>
                    <input type="text" name="year" class="form-control" value="{{ $placement->year }}" readonly>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    @else
        <div class="alert alert-warning">No proctor placement records available.</div>
    @endif
</div>
@endsection
