@extends('layouts.appstd')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Submit a Request</h2>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('requests.store') }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow-md">
        @csrf

        <div>
            <label for="message" class="block font-medium">Message:</label>
            <textarea name="message" id="message" rows="3" class="w-full border p-2" required></textarea>
        </div>

        <div>
            <label for="status" class="block font-medium">Status:</label>
            <select name="status" id="status" class="w-full border p-2" required>
                <option value="pending">Pending</option>
                <!-- <option value="approved">Approved</option>
                <option value="rejected">Rejected</option> -->
            </select>
        </div>

        <div>
            <label for="request_date" class="block font-medium">Request Date:</label>
            <input type="date" name="request_date" id="request_date" class="w-full border p-2" required readonly
                value="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>


        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection