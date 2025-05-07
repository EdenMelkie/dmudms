@extends('layouts.appproc')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📋 Requests Assigned to Your Block</h2>

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
                            <th scope="col">Approved By</th>
                            <th scope="col">Approved Date</th>
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
                                <td>{{ $request->approved_by ?? '-' }}</td>
                                <td>{{ $request->approved_date ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">No requests found for your block.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
