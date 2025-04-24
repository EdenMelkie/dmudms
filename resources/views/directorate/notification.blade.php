@extends('layouts.appdirectorate')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Directorate Reports</h1>

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
                <td>
                    @if($notification->user && $notification->user->employee)
                    {{ $notification->user->employee->first_name }} {{ $notification->user->employee->last_name }}
                    @else
                    <span class="text-danger">Unknown</span>
                    @endif
                </td>

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
                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </button>
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