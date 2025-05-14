@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Assign Proctors</h2>

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('coordinator.proctors.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="proctor">Select Proctor</label>
            <select class="form-control" id="proctor" name="employee_id">
                @foreach ($proctors as $proctor)
                <option value="{{ $proctor->employee_id }}">{{ $proctor->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="room">Select Room</label>
            <select class="form-control" id="room" name="block_id">
                @foreach ($blocks as $block)
                <option value="{{ $block->block_id }}">{{ $block->block_id }} {{ $block->reserved_for }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Enter Year</label>
            <input type="text" name="year" id="year" value="{{ date('Y') }}" readonly class="form-control" />
        </div>


        <button type="submit" class="btn btn-primary mt-3">Assign Proctor</button>
    </form>
</div>
@endsection