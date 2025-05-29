@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Manage Proctor Placements</h2>

    {{-- Success and Error Messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops! Something went wrong:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

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
            {{-- Update Form --}}
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

            {{-- Delete Form --}}
            <form action="{{ route('proctor.destroy', $placement->placement_id) }}" method="POST" class="text-end mt-2" onsubmit="return confirm('Are you sure you want to delete this placement?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-4">Delete</button>
            </form>
        </div>
    </div>
    @endforeach

    @else
    <div class="alert alert-warning">No proctor placement records available.</div>
    @endif
</div>
@endsection