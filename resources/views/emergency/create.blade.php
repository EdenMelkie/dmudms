@extends('layouts.appstd')

@section('content')
<div class="container">
    <h2>Emergency Contact Information</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('emergency.store') }}" method="POST">
        @csrf

        <label>Father Name:</label>
        <input type="text" name="father_name" class="form-control" required>

        <label>Grand Father:</label>
        <input type="text" name="grand_father" class="form-control" required>

        <label>Great Grand Father:</label>
        <input type="text" name="grand_grand_father" class="form-control">

        <label>Mother Name:</label>
        <input type="text" name="mother_name" class="form-control" required>

        <label>Phone:</label>
        <input type="text" name="phone" class="form-control" required>

        <label>Region:</label>
        <input type="text" name="region" class="form-control" required>

        <label>Woreda:</label>
        <input type="text" name="woreda" class="form-control" required>

        <label>Kebele:</label>
        <input type="text" name="kebele" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
