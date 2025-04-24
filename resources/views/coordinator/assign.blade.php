@extends('layouts.appcoordinator')

@section('content')
<div class="container mt-4">
    <h2>Assign Proctors</h2>

    <form method="POST" action="{{ route('coordinator.proctor.assign') }}">
        @csrf

        <div class="form-group">
            <label for="proctor">Select Proctor</label>
            <select class="form-control" id="proctor" name="proctor_id">
                @foreach ($proctors as $proctor)
                <option value="{{ $proctor->id }}">{{ $proctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="room">Select Room</label>
            <select class="form-control" id="room" name="room_id">
                @foreach ($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Assign Proctor</button>
    </form>
</div>
@endsection
