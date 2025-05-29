@extends('layouts.appstd')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Exit Paper Request Form</h2>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('exit_papers.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control" value="{{ session('username') }}" readonly>
                </div>

                <div id="items-container">
                    <div class="item-row row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Type of Cloth</label>
                            <input type="text" name="type[]" class="form-control" placeholder="e.g., T-shirt" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <input type="text" name="color[]" class="form-control" placeholder="e.g., Blue" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Number</label>
                            <input type="number" name="number[]" min="1" class="form-control" placeholder="e.g., 2" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-row">&times;</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-secondary mb-3" id="add-row">+ Add More</button>
                <button type="submit" class="btn btn-primary">Submit Exit Paper</button>
            </form>
        </div>
    </div>

    @if($exitPapers->count())
    <div class="mt-5">
        <h4 class="text-secondary">Your Submitted Exit Papers</h4>

        @php
        $groupedPapers = $exitPapers->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->request_date)->format('Y-m-d');
        });
        @endphp

        @foreach($groupedPapers as $date => $papers)
        <div class="card mt-4 border shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h5>

                <form action="{{ route('exit_papers.updateByDate') }}" method="POST" class="mb-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="request_date" value="{{ $date }}">

                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Color</th>
                                <th>Number</th>
                                <th>Requested At</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($papers as $i => $paper)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <input type="text" name="type[{{ $paper->exit_id }}]" value="{{ $paper->type }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="color[{{ $paper->exit_id }}]" value="{{ $paper->color }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="number[{{ $paper->exit_id }}]" value="{{ $paper->number }}" class="form-control" required>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($paper->request_date)->format('Y-m-d') }}</td>
                                <td> {{ $paper->status }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-warning">Update This Group</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info mt-4">
        You haven't submitted any exit paper requests yet.
    </div>
    @endif
</div>

<script>
    document.getElementById('add-row').addEventListener('click', function () {
        const container = document.getElementById('items-container');
        const row = document.createElement('div');
        row.classList.add('item-row', 'row', 'mb-3');
        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="type[]" class="form-control" placeholder="Type" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="color[]" class="form-control" placeholder="Color" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="number[]" class="form-control" placeholder="Number" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-row">&times;</button>
            </div>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('.item-row').remove();
        }
    });
</script>
@endsection
