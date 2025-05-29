@extends('layouts.appproc')

@section('content')
<div class="container">
    <h2 class="mb-4">Exit Papers for Your Assigned Blocks</h2>

    {{-- Filter Form --}}
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="status" class="form-label">Filter by Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">-- All --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="printed" {{ request('status') == 'printed' ? 'selected' : '' }}>Printed</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="request_date" class="form-label">Filter by Date</label>
                <input type="date" name="request_date" id="request_date" class="form-control" value="{{ request('request_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('exit_papers.viewByProctor') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    @if($students->isEmpty())
    <div class="alert alert-warning">No students found in your assigned blocks.</div>
    @else
    @foreach ($students as $student)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <strong>Student ID:</strong> {{ $student->student_id }} |
                <strong>Block:</strong> {{ $student->block }}
            </div>
            <button class="btn btn-sm btn-success" onclick="markPrintedAndPrint('{{ $student->student_id }}')">Print</button>
        </div>
        <div class="card-body" id="print-{{ $student->student_id }}">
            @php
            $studentPapers = $exitPapers->where('stud_id', $student->student_id);
            if (request('status')) {
            $studentPapers = $studentPapers->where('status', request('status'));
            }
            if (request('request_date')) {
            $studentPapers = $studentPapers->where('request_date', request('request_date'));
            }
            @endphp

            @if($studentPapers->isNotEmpty())
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Color</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th>Request Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentPapers as $index => $paper)
                    <tr class="{{ $paper->status === 'printed' ? 'printed-row' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $paper->type }}</td>
                        <td>{{ $paper->color }}</td>
                        <td>{{ $paper->number }}</td>
                        <td>{{ ucfirst($paper->status) }}</td>
                        <td>{{ \Carbon\Carbon::parse($paper->request_date)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <p><strong>Student ID:</strong> {{ $student->student_id }} {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</p>
                <p><strong>Approved by:</strong> {{ $proctor->employee_id ?? 'N/A' }} - {{ $proctor->first_name }} {{ $proctor->second_name }} {{ $proctor->last_name ?? 'Unknown' }}</p>
            </div>
            @endif
        </div>
    </div>
    @endforeach
    @endif
</div>

{{-- Print Script --}}
<script>
    function markPrintedAndPrint(studentId) {
        const status = document.getElementById('status').value;
        const requestDate = document.getElementById('request_date').value;

        fetch("{{ route('exit_papers.markAsPrinted') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    student_id: studentId,
                    status: status,
                    request_date: requestDate
                })
            })
            .then(response => {
                if (!response.ok) throw new Error("Failed to update status.");
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                printDivFiltered('print-' + studentId);
            })
            .catch(error => alert("Error: " + error));
    }

    function printDivFiltered(divId) {
        const div = document.getElementById(divId);
        const clone = div.cloneNode(true);

        // Remove rows with class 'printed-row' so they won't be printed
        clone.querySelectorAll('.printed-row').forEach(row => row.remove());

        const printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>table {width: 100%; border-collapse: collapse;} th, td {border: 1px solid #000; padding: 8px;}</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(clone.innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>

@endsection