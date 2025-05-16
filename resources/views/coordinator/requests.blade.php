@extends('layouts.appproc')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        📋 Requests Assigned to block:
        @foreach($proctorBlocks as $block)
        <span class="badge bg-info">{{ $block }}</span>
        @endforeach
    </h2>

    <div class="card shadow rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Request ID</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Message</th>
                            <th scope="col">Status</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                        <tr>
                            <td>{{ $request->request_id }}</td>
                            <td>{{ $request->student_id }}</td>
                            <td>{{ $request->message }}</td>
                            <td>
                                <span class="badge 
                                        @if($request->status === 'approved') bg-success
                                        @elseif($request->status === 'pending') bg-warning
                                        @elseif($request->status === 'rejected') bg-danger
                                        @else bg-secondary
                                        @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>{{ $request->request_date }}</td>
                            <td>
                                @if($request->status === 'pending')
                                <form action="{{ route('requests.approve', $request->request_id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $request->request_id }}">
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>

                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted">No requests found for your block(s).</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection