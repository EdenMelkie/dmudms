@extends('layouts.appproc')

@section('styles')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 0.95rem;
    }

    table th, table td {
        border: 1px solid #ccc;
        padding: 10px 12px;
        text-align: left;
    }

    table th {
        background-color: #007bff; /* Bootstrap blue */
        color: #fff; /* White text */
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #e6f7ff;
        transition: background-color 0.3s ease;
    }

    h3 {
        margin-bottom: 15px;
        color: #333;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

                <div class="card-body">
                    

                    <h3>Proctors assigned to Block: {{ $block }}</h3>

                    <table border="1">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Proctor ID</th>
                                <th>Year</th>
                                <th>First Entry</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proctors as $proctor)
                            <tr>
                                <td>{{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name }}</td>
                                <td>{{ $proctor->gender }}</td>
                                <td>{{ $proctor->phone }}</td>
                                <td>{{ $proctor->email }}</td>
                                <td>{{ $proctor->proctor_id }}</td>
                                <td>{{ $proctor->year }}</td>
                                <td>{{ $proctor->first_entry }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No proctors found for this block.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
    </div>
</div>
@endsection