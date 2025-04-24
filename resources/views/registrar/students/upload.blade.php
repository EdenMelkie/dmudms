@extends('layouts.appregistrar')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Upload Students File</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Choose CSV File</label>
            <input type="file" name="file" id="file" class="form-control" required accept=".csv">
        </div>

        <button type="submit" class="btn btn-primary w-100">Upload</button>
    </form>
</div>
@endsection
