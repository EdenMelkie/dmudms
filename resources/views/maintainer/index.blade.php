@extends('layouts.appmain')

@section('content')
<div class="container">
    <h1>Maintainer Page</h1>

    <h2>Requests List</h2>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 14px;
            text-align: left;
        }

        thead tr:first-child {
            background-color: #4CAF50;
            color: white;
        }

        thead tr:nth-child(2) {
            background-color: #66bb6a;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        th {
            font-weight: bold;
        }
    </style>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Request ID</th>
                <th rowspan="2">Student ID</th>
                <th rowspan="2">Message</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Request Date</th>
                <th rowspan="2">Approved Date</th>
                <th colspan="2">Approved By</th>
            </tr>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->request_id }}</td>
                <td>{{ $request->student_id }}</td>
                <td>{{ $request->message }}</td>
                <td>{{ $request->status }}</td>
                <td>{{ $request->request_date }}</td>
                <td>{{ $request->approved_date }}</td>
                <td>{{ $request->first_name }} {{ $request->second_name }} {{ $request->last_name }}</td>
                <td>{{ $request->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
