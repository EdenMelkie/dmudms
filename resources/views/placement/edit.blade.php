@extends('layouts.appstd')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg max-w-3xl">
    <h2 class="text-3xl font-extrabold mb-6">Edit Replacement Request</h2>

    <form action="{{ route('replacements.update', $request->request_id) }}" method="POST" autocomplete="off" class="space-y-6 bg-white p-8 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div>
            <label for="message" class="block text-lg font-semibold text-gray-800 mb-2">Reason:</label>
            <textarea name="message" id="message" rows="6" required
                class="w-full border border-gray-300 rounded-lg p-4 text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition duration-200 ease-in-out resize-none font-medium shadow-sm"
                placeholder="Please enter the reason for replacement...">{{ old('message', $request->message) }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                       focus:ring-4 focus:ring-blue-500 focus:outline-none
                       text-white font-bold px-8 py-3 rounded-lg shadow-xl transition duration-300
                       transform hover:scale-105">
                Update Request
            </button>
        </div>
    </form>
</div>
@endsection
