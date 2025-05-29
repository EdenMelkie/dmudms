@extends('layouts.appstd')

@section('content')
<div class="container mx-auto max-w-4xl p-4">

    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4 shadow">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    @if($requests->count())
    <div class="table-responsive rounded-lg border border-gray-300 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-700 mb-3 text-center">🛠️ Your Previous Maintenance Requests</h3>
        <table class="table table-striped table-hover mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col" class="py-3 px-4">#</th>
                    <th scope="col" class="py-3 px-4">Reason</th>
                    <th scope="col" class="py-3 px-4">Status</th>
                    <th scope="col" class="py-3 px-4">Date</th>
                    <th scope="col" class="py-3 px-4">Document</th>
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
                    <td class="align-middle">
                        @if($req->image_path)
                        <a href="{{ asset($req->image_path) }}" target="_blank">
                            <img src="{{ asset($req->image_path) }}" alt="Image" style="width: 35px; height: auto; border-radius: 4px;">
                        </a>
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td class="align-middle d-flex gap-2">

                        <!-- Edit Button -->
                        <a href="{{ route('requests.edit', $req->request_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                        @if($req->status === 'approved')
                        <!-- Mark as Done Button -->
                        <form action="{{ route('requests.markDone', $req->request_id) }}" method="POST" class="m-0 p-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-success"
                                onclick="return confirm('Mark this request as done?')">
                                Mark as Done
                            </button>
                        </form>
                        @endif

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

<div class="flex justify-center items-start mt-10">
    <div class="w-full max-w-xl bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">📝 Submit a Maintenance Request</h2>

        <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label for="message" class="block font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" id="message" rows="4" class="w-full border rounded p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
            </div>

            <div>
                <label for="status" class="block font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full border rounded p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div>
                <label for="request_date" class="block font-medium text-gray-700 mb-1">Request Date</label>
                <input type="date" name="request_date" id="request_date" class="w-full border rounded p-3 bg-gray-100 text-gray-700" readonly
                    value="{{ \Carbon\Carbon::now()->toDateString() }}">
            </div>

            <div>
                <label for="image" class="block font-medium text-gray-700 mb-1">Upload Image</label>
                <input type="file" name="image" class="w-full border rounded p-2 bg-white shadow-sm 
                    file:mr-4 file:py-2 file:px-4 
                    file:border-0 file:rounded-md 
                    file:text-sm file:font-semibold 
                    file:bg-blue-50 file:text-blue-700 
                    hover:file:bg-blue-100">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded shadow transition duration-200">
                    Submit Request
                </button>
            </div>
        </form>
    </div>
</div>


</div>
@endsection