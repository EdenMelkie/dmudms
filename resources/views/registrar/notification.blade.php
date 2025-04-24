@extends('layouts.appregistrar')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Registrar Notifies Assigner</h1>

    <!-- Notification Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Create New Notification</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('registrar.notifications.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="registrar_id" class="form-label">Registrar ID</label>
                    <input type="text" class="form-control" id="registrar_id" name="registrar_id"
                        value="{{ auth()->user()->username }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Notification</button>
            </form>
        </div>
    </div>

    <!-- Notification Table -->
    <!-- Report Table -->
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Notification ID</th>
                <th>Registrar ID</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($notifications as $notification)
            <tr>
                <td>{{ $notification->notification_id }}</td>
                <td>{{ $notification->registrar_id }}</td>
                <td>{{ $notification->message }}</td>
                <td>
                    <span class="badge 
                                @if($notification->status == 'Read') 
                                    bg-success
                                @elseif($notification->status == 'Unread')
                                    bg-warning text-dark
                                @endif
                            ">
                        {{ $notification->status }}
                    </span>
                </td>
                <td>{{ $notification->date }}</td>
               
                <td>
                    <form action="{{ route('registrar.notifications.delete', $notification->notification_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    <strong>There are no notifications</strong>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection