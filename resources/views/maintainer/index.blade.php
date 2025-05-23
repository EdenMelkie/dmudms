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
                <th rowspan="2">B/R</th>
                <th rowspan="2">Message</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Requested By</th>
                <th rowspan="2">Approved Date</th>
                <th colspan="2">Approved By</th>
            </tr>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->placed?->block }}/{{ $req->placed?->room }}</td>
                <td>{{ $req->message }}</td>
                <td>{{ $req->status }}</td>
                <td>{{ $req->student?->first_name }}</td>
                <td>{{ $req->approved_date }}</td>
                <td>{{ $req->first_name }} {{ $req->second_name }} {{ $req->last_name }}</td>
                <td>{{ $req->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
