@extends('layouts.appstd')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg max-w-3xl">
    <h2 class="text-3xl font-extrabold mb-6">Edit Replacement Request</h2>

    <form action="{{ route('requests.update', $request->request_id) }}" method="POST" enctype="multipart/form-data" autocomplete="off"
        class="space-y-6 bg-white p-8 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Reason Textarea -->
        <div>
            <label for="message" class="block text-lg font-semibold text-gray-800 mb-2">Reason:</label>
            <textarea name="message" id="message" rows="6" required
                class="w-full border border-gray-300 rounded-lg p-4 text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-400 focus:border-blue-500 transition duration-200 ease-in-out resize-none font-medium shadow-sm"
                placeholder="Please enter the reason for replacement...">{{ old('message', $request->message) }}</textarea>
        </div>

        <!-- Image Upload Section -->
        <div>
            <label for="image" class="block text-lg font-semibold text-gray-800 mb-2">Upload New Image (optional):</label>
            <input type="file" name="image" id="image"
                class="w-full border rounded-lg p-2 bg-white shadow-sm 
                       file:mr-4 file:py-2 file:px-4 
                       file:border-0 file:rounded-md 
                       file:text-sm file:font-semibold 
                       file:bg-blue-50 file:text-blue-700 
                       hover:file:bg-blue-100">

            @if($request->image_path)
            <p class="mt-2 text-sm text-gray-600">Previously uploaded image:</p>
            <a href="{{ asset($request->image_path) }}" target="_blank" class="inline-block mt-1">
                <img src="{{ asset($request->image_path) }}"
                    alt="Current Image"
                    width="100px"
                    class="object-cover border rounded shadow hover:scale-150 transition-transform duration-300">
            </a>
            @endif

        </div>



        <!-- Submit Button -->
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