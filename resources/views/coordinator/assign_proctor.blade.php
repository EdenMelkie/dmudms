@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Assign Proctor to Block: {{ $block->block_id }}</h3>

    <form action="{{ route('proctor.place.store', $block->block_id) }}" method="POST">
        @csrf
        <input type="hidden" name="block_id" value="{{ $block->block_id }}">

        <div class="mb-3">
            <label for="proctor_id" class="form-label">Select Proctor</label>
            <select name="proctor_id" class="form-select" required>
                <option value="">Select proctor</option> <!-- Ensure this is empty as the default -->
                @foreach($availableProctors as $proctor)
                <option value="{{ $proctor->username }}">
                   {{ $proctor->username }} {{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>
    </form>


</div>
@endsection