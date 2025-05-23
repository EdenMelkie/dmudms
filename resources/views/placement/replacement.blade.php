@extends('layouts.appstd')

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

<!-- My Requests Table -->

<div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg">

    <!-- Header -->
    <h2 class="text-3xl font-extrabold text-indigo-700 mb-6 border-b border-indigo-300 pb-2">My Submitted Requests</h2>

    @if($requests->count())
    <div class="table-responsive rounded-lg border border-gray-300 shadow-sm">
        <table class="table table-striped table-hover mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Reason</th>
                    <th scope="col" class="py-3 px-4">Status</th>
                    <th scope="col" class="py-3 px-4">Date</th>
                    <th scope="col" class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                <tr>
                    <th scope="row" class="align-middle">{{ $req->request_id }}</th>
                    <td class="align-middle">{{ $req->message }}</td>
                    <td class="align-middle text-capitalize">
                        @if($req->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($req->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                        @elseif($req->status === 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                        @else
                        <span class="badge bg-secondary">{{ $req->status }}</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ $req->request_date }}</td>
                    <td class="align-middle d-flex gap-2">

                        <!-- Edit Button -->
                        <a href="{{ route('replacements.edit', $req->request_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('replacements.destroy', $req->request_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?')" class="m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-gray-600 italic mt-4">No requests found.</p>
    @endif
</div>

<hr>

<div class="container mx-auto p-8 bg-gray-50 rounded-lg shadow-lg max-w-7xl">

    <!-- Header -->
    <h2 class="text-4xl font-extrabold text-gray-900 mb-10 border-b border-gray-300 pb-3 tracking-tight">
        Submit a Replacement Request
    </h2>

    <!-- Request Form -->
    <form
        action="{{ route('replacements.store') }}"
        method="POST"
        class="space-y-8 bg-white p-10 rounded-xl shadow-lg max-w-3xl mx-auto"
        autocomplete="off">
        @csrf

        <div>
            <label
                for="message"
                class="block text-lg font-semibold text-gray-800 mb-3">
                Reason:
            </label>
            <textarea
                name="message"
                id="message"
                rows="6"
                class="w-full max-w-full min-h-[180px] border border-gray-300 rounded-lg p-5 text-gray-900 placeholder-gray-400
                       focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition duration-200
                       ease-in-out resize-none font-medium shadow-sm"
                placeholder="Write a reason why you wanna a replacement..." required></textarea>
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="status" value="pending" />
        <input type="hidden" name="request_date" value="{{ \Carbon\Carbon::now()->toDateString() }}" />
        <input type="hidden" name="student_id" value="{{ session('username') }}" />
        <input type="hidden" name="approved_by" value="" />
        <input type="hidden" name="approved_date" value="" />

        <div class="text-right">
            <button
                type="submit"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                       focus:ring-4 focus:ring-blue-500 focus:outline-none
                       text-white font-bold px-10 py-3 rounded-lg shadow-xl transition duration-300
                       transform hover:scale-105">
                Submit Request
            </button>
        </div>
    </form>
</div>

@endsection