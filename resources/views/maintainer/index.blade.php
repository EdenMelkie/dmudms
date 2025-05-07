@extends('layouts.appmain')

@section('content')
    <div class="container">
        <h1>Maintainer Page</h1>

        <!-- Example: Displaying a list of requests -->
        <h2>Requests List</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Student ID</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>Approved By</th>
                    <th>Approved Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->request_id }}</td>
                        <td>{{ $request->student_id }}</td>
                        <td>{{ $request->message }}</td>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->request_date }}</td>
                        <td>{{ $request->approved_by }}</td>
                        <td>{{ $request->approved_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">There are no requests.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
