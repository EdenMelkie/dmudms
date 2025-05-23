@extends('layouts.appdirectorate')

@section('content')

<!-- Success Message -->
@if(session('success'))
<div class="max-w-2xl mx-auto mb-10" style="background-color: black; color: white;">
    <div class="bg-green-50 border border-green-300 text-green-800 px-6 py-4 rounded-lg shadow-md">
        <div class="font-semibold text-lg">
            ✅ {{ session('success') }}
        </div>
    </div>
</div>
@endif

<!-- Divider -->
<hr class="my-10 border-gray-300">

<!-- Approved Replacement Requests Table -->
<div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg">

    <!-- Header -->
    <h2 class="text-3xl font-extrabold text-indigo-700 mb-6 border-b border-indigo-300 pb-2">
        Approved Replacement Requests
    </h2>

    @if($requests->count())
    <div class="table-responsive rounded-lg border border-gray-300 shadow-sm">
        <table class="table table-striped table-hover mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="py-3 px-4">Student ID</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Gender</th>
                    <th class="py-3 px-4">Message</th>
                    <th class="py-3 px-4">Block / Room</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                <tr>
                    <td class="align-middle">{{ $req->student_id }}</td>
                    <td class="align-middle">
                        {{ $req->student?->first_name }} {{ $req->student?->second_name }}
                    </td>
                    <td class="align-middle">{{ $req->student?->gender ?? 'N/A' }}</td>
                    <td class="align-middle">{{ $req->message }}</td>
                    <td class="align-middle">
                        @if($req->placed)
                        Block: {{ $req->placed->block }}<br>
                        Room: {{ $req->placed->room }}
                        @else
                        <span class="text-muted">Not Assigned</span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <span class="badge bg-success">Approved</span>
                    </td>
                    <td class="align-middle">{{ $req->request_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-gray-600 italic mt-4">No approved replacement requests found.</p>
    @endif
</div>

@endsection