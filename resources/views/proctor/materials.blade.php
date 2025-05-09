@extends('layouts.appproc')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Registered Materials</h2>

    @if($materials->isEmpty())
    <div class="alert alert-info text-center">No materials registered yet.</div>
    @else
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Block</th>
                        <th>Room</th>
                        <th>Unlocker</th>
                        <th>Locker</th>
                        <th>Chair</th>
                        <th>Pure Foam</th>
                        <th>Damaged Foam</th>
                        <th>Tiras</th>
                        <th>Tables</th>
                        <th>Chibud</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $index => $material)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material->block }}</td>
                        <td>{{ $material->room }}</td>
                        <td>{{ $material->unlocker }}</td>
                        <td>{{ $material->locker }}</td>
                        <td>{{ $material->chair }}</td>
                        <td>{{ $material->pure_foam }}</td>
                        <td>{{ $material->damaged_foam }}</td>
                        <td>{{ $material->tiras }}</td>
                        <td>{{ $material->tables }}</td>
                        <td>{{ $material->chibud }}</td>
                        <td>{{ $material->created_at ? $material->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('materials.edit', $material->registration_id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('materials.destroy', $material->registration_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this material?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-3 text-right">
            <a href="{{ route('materials.create') }}" class="btn btn-success">Register New Materials</a>
        </div>

    </div>
    @endif
</div>
@endsection